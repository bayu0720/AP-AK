@extends('layouts.app')

@section('content')
<div class="container-fluid">

  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
  </div>

  <!-- Content Row -->
  <div class="row">
    <div class="col-12">
      <div class="alert border-left-secondary shadow alert-warning alert-dismissible fade shadow show" role="alert">
        <strong>Selamat Datang!</strong> Anda telah masuk sebagai <strong>{{ Auth::user()->name }}</strong>.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">
            &times;
          </span>
        </button>
      </div>
    </div>
  </div>

  <!-- Content Row -->
  <div class="row">
    <!-- Balance Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                Balance
              </div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">
                {{ number_format($total_balance, 0, ',', '.') }}
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-money-bill-wave fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Income Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                Incomes
              </div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">
                {{ number_format($total_incomes, 0, ',', '.') }}
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-arrow-down fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Expense Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                Expense
              </div>
              <div class="row no-gutters align-items-center">
                <div class="col-auto">
                  <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                    {{ number_format($total_expenses, 0, ',', '.') }}
                  </div>
                </div>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-arrow-up fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Category Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                Category
              </div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">
                {{ $total_categories }}
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-tags fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Grafik Donat Income vs Expense -->
<div class="row mt-4">
  <div class="col-md-6">
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-success">Perbandingan Pemasukan vs Pengeluaran</h6>
      </div>
      <div class="card-body">
        <canvas id="incomeVsExpenseChart"></canvas>
      </div>
    </div>
  </div>

  <!-- Pie kategori dengan pengeluaran tertinggi -->
  <div class="col-md-6">
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-warning">Proporsi Pengeluaran per Kategori</h6>
      </div>
      <div class="card-body">
        <canvas id="expensePieChart"></canvas>
      </div>
    </div>
  </div>
</div>

<!-- Grafik Batang: Pengeluaran Berdasarkan Kategori -->
<div class="row mt-4">
  <div class="col-12">
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-info">Grafik Pengeluaran Berdasarkan Kategori</h6>
      </div>
      <div class="card-body">
        <canvas id="expenseCategoryChart" style="max-height: 320px;"></canvas>
      </div>
    </div>
  </div>
</div>

<!-- Grafik Garis: Pengeluaran per Bulan -->
<div class="row mt-4">
  <div class="col-12">
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Grafik Pengeluaran per Bulan</h6>
      </div>
      <div class="card-body">
        <canvas id="monthlyExpenseChart" style="max-height: 320px;"></canvas>
      </div>
    </div>
  </div>
</div>


  <!-- Table ( Income, Expanse ) Content -->
  <div class="row">
    <div class="col-12 col-sm-12">
      <div class="table">
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-secondary">Income & Expense</h6>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <!-- <th>No</th>
                    <th>Jenis</th> -->
                    <th>Amount</th>
                    <th>Description</th>
                    <th>Date</th>
                    <th>Category</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($incomesAndExpenses as $index => $incomeAndExpense)
                  <tr>
                    <!-- <td>{{ $index + 1 }}</td>
                    <td>
                      @if($incomeAndExpense instanceof App\Incomes)
                      <span class="badge badge-success">Pemasukan</span>
                      @elseif($incomeAndExpense instanceof App\Expenses)
                      <span class="badge badge-danger">Pengeluaran</span>
                      @endif
                    </td> -->
                    <td>{{ number_format($incomeAndExpense->amount, 0, ',', '.') }}</td>
                    <td>{{ $incomeAndExpense->description }}</td>
                    <td>{{ $incomeAndExpense->date }}</td>
                    <td>
                      @foreach($categories as $category)
                      @if($category->id_category == $incomeAndExpense->id_category)
                      {{ $category->name_category }}
                      @endif
                      @endforeach
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
  document.addEventListener("DOMContentLoaded", function () {
    // Grafik Batang per Kategori
    const ctx = document.getElementById('expenseCategoryChart').getContext('2d');
    const expenseCategoryChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: {!! json_encode($categoryNames) !!},
        datasets: [{
          label: 'Total Pengeluaran',
          data: {!! json_encode($categoryTotals) !!},
          backgroundColor: 'rgba(54, 162, 235, 0.7)',
          borderColor: 'rgba(54, 162, 235, 1)',
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        scales: {
          y: {
            beginAtZero: true,
            ticks: {
              callback: function (value) {
                return value.toLocaleString("id-ID");
              }
            }
          }
        }
      }
    });

    // Grafik Garis per Bulan
    const monthlyCtx = document.getElementById('monthlyExpenseChart').getContext('2d');
    const monthlyExpenseChart = new Chart(monthlyCtx, {
      type: 'line',
      data: {
        labels: {!! json_encode($months) !!}, // Contoh: ['2025-01', '2025-02']
        datasets: [{
          label: 'Pengeluaran Bulanan',
          data: {!! json_encode($monthlyTotals) !!},
          backgroundColor: 'rgba(255, 99, 132, 0.2)',
          borderColor: 'rgba(255, 99, 132, 1)',
          borderWidth: 2,
          tension: 0.4,
          fill: true,
          pointRadius: 4,
          pointHoverRadius: 6
        }]
      },
      options: {
        responsive: true,
        scales: {
          y: {
            beginAtZero: true,
            ticks: {
              callback: function(value) {
                return value.toLocaleString("id-ID");
              }
            }
          }
        }
      }
    });
  });

      // Donut Chart: Income vs Expense
    const incomeVsExpenseCtx = document.getElementById('incomeVsExpenseChart').getContext('2d');
    const incomeVsExpenseChart = new Chart(incomeVsExpenseCtx, {
      type: 'doughnut',
      data: {
        labels: ['Pemasukan', 'Pengeluaran'],
        datasets: [{
          data: [{{ $total_incomes }}, {{ $total_expenses }}],
          backgroundColor: [
            'rgba(40, 167, 69, 0.7)', // success green
            'rgba(220, 53, 69, 0.7)'  // danger red
          ],
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        plugins: {
          legend: {
            position: 'bottom'
          }
        }
      }
    });

    // Pie Chart: Expense per Category
    const pieCtx = document.getElementById('expensePieChart').getContext('2d');
    const pieChart = new Chart(pieCtx, {
      type: 'pie',
      data: {
        labels: {!! json_encode($categoryNames) !!},
        datasets: [{
          data: {!! json_encode($categoryTotals) !!},
          backgroundColor: [
            'rgba(255, 99, 132, 0.7)',
            'rgba(54, 162, 235, 0.7)',
            'rgba(255, 206, 86, 0.7)',
            'rgba(75, 192, 192, 0.7)',
            'rgba(153, 102, 255, 0.7)',
            'rgba(255, 159, 64, 0.7)'
          ]
        }]
      },
      options: {
        responsive: true,
        plugins: {
          legend: {
            position: 'bottom'
          }
        }
      }
    });

</script>
@endpush

@push('styles')
<style>
  .card-header h6 {
    font-size: 1rem;
  }
  .card-body canvas {
    max-height: 320px;
  }
</style>
@endpush



</div>
@endsection