<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\PDFService;

class CustomerController extends Controller
{
    protected $pdfService;

    public function __construct(PDFService $pdfService)
    {
        $this->pdfService = $pdfService;
    }

    public function index()
    {
        $customers = DB::table('customers')->paginate(10);  // Gunakan paginate untuk data yang dipaginasi
        
        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'sex' => 'required',
            'marital_status' => 'required',
            'age' => 'required|integer',
            'education' => 'required',
            'income' => 'required|integer',
            'occupation' => 'required|string',
            'settlement_size' => 'required',
        ]);

        Customer::create([
            'sex' => $request->sex,
            'marital_status' => $request->marital_status,
            'age' => $request->age,
            'education' => $request->education,
            'income' => $request->income,
            'occupation' => $request->occupation,
            'settlement_size' => $request->settlement_size,
            'cluster' => null, // Cluster akan diisi setelah clustering
        ]);

        return redirect()->route('customers.index')->with('success', 'Customer added successfully.');
    }

    public function showClusteringForm()
    {
        return view('customers.clustering_form');
    }

    public function processClustering(Request $request)
    {
        $request->validate([
            'clusters' => 'required|integer|min:1',
            'max_iterations' => 'required|integer|min:1',
        ]);

        $k = $request->input('clusters');
        $maxIterations = $request->input('max_iterations');

        // Fetch data from DB
        $customers = DB::table('customers')->get()->toArray();
        
        // Extract only age and income for clustering
        $data = array_map(function($customer) {
            return [
                $customer->age, 
                $customer->income
            ];
        }, $customers);

        // Apply KMeans Clustering
        list($clusters, $iterations) = $this->kmeans($data, $k, $maxIterations);

        // Update clusters in DB
        foreach ($customers as $index => $customer) {
            DB::table('customers')
                ->where('id', $customer->id)
                // ->update(['cluster' => $clusters[$index]]);
                ->update(['cluster' => $clusters[$index] + 1]);
        }

        session(['iterations' => $iterations]);
        // Redirect to the clustering result page with iteration details
        return redirect()->route('customers.showProsesKmeans')->with(['iterations' => $iterations, 'clusters' => $clusters]);
    }

    public function showProsesKmeans()
    {
        $iterations = session('iterations');
        $clusters = session('clusters');
        
        return view('customers.proses_kmeans', compact('iterations', 'clusters'));
    }


    public function clearClusters()
    {
        DB::table('customers')->update(['cluster' => null]);

        return redirect()->route('customers.index')->with('success', 'Clusters have been cleared.');
    }

    private function kmeans($data, $k, $maxIterations)
    {
        srand(42); // Menggunakan seed tetap
        $centroids = $this->initializeCentroids($data, $k);
        $assignments = [];
        $iterations = [];

        for ($iteration = 0; $iteration < $maxIterations; $iteration++) {
            $newAssignments = [];
            foreach ($data as $point) {
                $newAssignments[] = $this->closestCentroid($point, $centroids);
            }

            if ($newAssignments == $assignments) {
                break;
            }

            $assignments = $newAssignments;
            $centroids = $this->updateCentroids($data, $assignments, $k);
            $iterations[] = ['centroids' => $centroids, 'assignments' => $assignments, 'data' => $data];
        }

        return [$assignments, $iterations];
    }

    private function initializeCentroids($data, $k)
    {
        $centroids = [];
        $indices = array_rand($data, $k);
        foreach ($indices as $index) {
            $centroids[] = $data[$index];
        }
        return $centroids;
    }

    private function closestCentroid($point, $centroids)
    {
        $minDistance = null;
        $closest = null;
        foreach ($centroids as $index => $centroid) {
            $distance = $this->euclideanDistance($point, $centroid);
            if ($minDistance === null || $distance < $minDistance) {
                $minDistance = $distance;
                $closest = $index;
            }
        }
        return $closest;
    }

    private function euclideanDistance($point1, $point2)
    {
        $sum = 0;
        foreach ($point1 as $i => $value) {
            $sum += pow((float)$value - (float)$point2[$i], 2);
        }
        return sqrt($sum);
    }

    private function updateCentroids($data, $assignments, $k)
    {
        $centroids = array_fill(0, $k, array_fill(0, count($data[0]), 0));
        $counts = array_fill(0, $k, 0);

        foreach ($assignments as $index => $cluster) {
            foreach ($data[$index] as $i => $value) {
                $centroids[$cluster][$i] += (float)$value;
            }
            $counts[$cluster]++;
        }

        foreach ($centroids as $i => &$centroid) {
            foreach ($centroid as $j => &$value) {
                $value /= max($counts[$i], 1);  // Avoid division by zero
            }
        }

        return $centroids;
    }

    public function visualization()
{
    $clusters = DB::table('customers')
                  ->select('cluster', DB::raw('count(*) as total'))
                  ->groupBy('cluster')
                  ->get();

    $dataPoints = DB::table('customers')
                    ->select('id', 'age', 'income', 'cluster')
                    ->get();
    $hasClusters = Customer::whereNotNull('cluster')->exists();
    return view('customers.visualization', compact('clusters', 'dataPoints', 'hasClusters'));
}

    public function clusteringResult()
{
    $clusters = DB::table('customers')->whereNotNull('cluster')->paginate(10);

    // Generate conclusions
    $conclusions = $this->generateConclusions($clusters);

    return view('customers.clustering_result', compact('clusters', 'conclusions'));
}

private function generateConclusions($clusters)
    {
        $clusterData = [];
        foreach ($clusters as $customer) {
            $clusterData[$customer->cluster][] = $customer;
        }

        $conclusions = [];
        foreach ($clusterData as $cluster => $data) {
            $totalAge = 0;
            $totalIncome = 0;
            $count = count($data);

            foreach ($data as $customer) {
                $totalAge += $customer->age;
                $totalIncome += $customer->income;
            }

            $averageAge = $totalAge / $count;
            $averageIncome = $totalIncome / $count;

            $conclusions[] = [
                'cluster' => $cluster,  // Tidak perlu menambahkan 1 di sini karena sudah dilakukan saat penyimpanan
                'average_age' => round($averageAge, 2),
                'average_income' => 'Rp ' . number_format($averageIncome, 2, ',', '.'),
                'count' => $count
            ];
        }

        return $conclusions;
    }

    public function downloadReport()
    {
        $clusters = Customer::whereNotNull('cluster')->get();

        // Generate conclusions
        $conclusions = $this->generateConclusions($clusters);

        $pdf = $this->pdfService->generatePDF('customers.report', compact('conclusions'));
        return response($pdf)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="analysis_report.pdf"');
    }


}