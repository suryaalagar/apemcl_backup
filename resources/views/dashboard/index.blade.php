@extends('layouts.app')
@section('content')
 <!--stats-->
 <div class="row">
    <div class="col-xl-3 col-lg-6 col-12">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <div class="media">
                        <div class="media-body text-left w-100">
                            <h3 class="primary">78</h3>
                            <span>Total Vehicles</span>
                        </div>
                        <div class="media-right media-middle">
                            <i class="fa fa-bus primary font-large-2 float-right"></i>
                        </div>
                    </div>
                    <div class="progress progress-sm mt-1 mb-0">
                      <div class="progress-bar bg-primary" role="progressbar" style="width: 80%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-12">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <div class="media">
                        <div class="media-body text-left w-100">
                            <h3 class="danger">423</h3>
                            <span>Total Drivers</span>
                        </div>
                        <div class="media-right media-middle">
                            <i class="fa fa-user-circle-o danger font-large-2 float-right"></i>
                        </div>                        
                    </div>
                    <div class="progress progress-sm mt-1 mb-0">
                      <div class="progress-bar bg-danger" role="progressbar" style="width: 40%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-12">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <div class="media">
                        <div class="media-body text-left w-100">
                            <h3 class="success">75</h3>
                            <span>Total Customers</span>
                        </div>
                        <div class="media-right media-middle">
                            <i class="fa fa-users success font-large-2 float-right"></i>
                        </div>                        
                    </div>
                    <div class="progress progress-sm mt-1 mb-0">
                      <div class="progress-bar bg-success" role="progressbar" style="width: 60%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>    
    <div class="col-xl-3 col-lg-6 col-12">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <div class="media">
                        <div class="media-body text-left w-100">
                            <h3 class="success">40</h3>
                            <span>Total Trips</span>
                        </div>
                        <div class="media-right media-middle">
                            <i class="fa fa-users primary font-large-2 float-right"></i>
                        </div>                        
                    </div>
                    <div class="progress progress-sm mt-1 mb-0">
                      <div class="progress-bar bg-success" role="progressbar" style="width: 60%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  
</div>
<!--/stats-->
<div class="row match-height">
    <div class="col-xl-8 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Recent Trips</h4>
                <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li><a data-action="reload"><i class="feather icon-rotate-cw"></i></a></li>
                        <li><a data-action="expand"><i class="feather icon-maximize"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="card-content">
                {{-- <div class="card-body">
                    <p>Total paid invoices 240, unpaid 150. <span class="float-right"><a href="project-summary.html" target="_blank">Invoice Summary <i class="feather icon-arrow-right"></i></a></span></p>
                </div> --}}
                <div class="table-responsive">
                    <table id="recent-orders" class="table table-hover mb-0 ps-container ps-theme-default">
                        <thead>
                            <tr>
                                <th>Trip Date</th>
                                <th>Vehicle Number</th>
                                <th>Route Name</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-truncate">2023-07-15</td>
                                <td class="text-truncate">TN42SD4562</td>
                                <td class="text-truncate">Chennai To Trichy</td>
                                <td class="text-truncate"><span class="badge badge-success">Complete</span></td>
                            </tr>
                            <tr>
                                <td class="text-truncate">2023-07-18</td>
                                <td class="text-truncate">TN42SD4578</td>
                                <td class="text-truncate">Madurai To Cbe</td>
                                <td class="text-truncate"><span class="badge badge-primary">Processing</span></td>
                            </tr>
                            <tr>
                                <td class="text-truncate">2023-07-15</td>
                                <td class="text-truncate">TN42SD4562</td>
                                <td class="text-truncate">Chennai To Trichy</td>
                                <td class="text-truncate"><span class="badge badge-danger">Delay</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-lg-12">
        <div class="card">
            <div class="card-content">
                <div class="card-body sales-growth-chart">
                    <div id="monthly-sales" class="height-250"></div>
                </div>
            </div>
            <div class="card-footer">
                <div class="chart-title mb-1 text-center">
                    <h6>Total monthly Sales.</h6>
                </div>
                <div class="chart-stats text-center">
                    <a href="#" class="btn btn-sm btn-primary mr-1">Statistics <i class="feather icon-bar-chart"></i></a> <span class="text-muted">for the last year.</span>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script> --}}
@endsection
