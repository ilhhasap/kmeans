<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;

Route::get('/customers/clustering', [CustomerController::class, 'showClusteringForm'])->name('customers.showClusteringForm');
Route::post('/customers/process-clustering', [CustomerController::class, 'processClustering'])->name('customers.processClustering');
Route::get('/customers/proses-kmeans', [CustomerController::class, 'showProsesKmeans'])->name('customers.showProsesKmeans');
Route::get('/customers/clustering-result', [CustomerController::class, 'clusteringResult'])->name('customers.clusteringResult');
Route::get('/customers/visualization', [CustomerController::class, 'visualization'])->name('customers.visualization');
Route::get('/customers/clear-clusters', [CustomerController::class, 'clearClusters'])->name('customers.clearClusters');

// Route lainnya
Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');
Route::get('/customers/create', [CustomerController::class, 'create'])->name('customers.create');
Route::post('/customers', [CustomerController::class, 'store'])->name('customers.store');
Route::get('/customers/download-report', [CustomerController::class, 'downloadReport'])->name('customers.downloadReport');
