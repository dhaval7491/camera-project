@extends('superadmin.layouts.app')
@section('content')
<div class="dashboard-graphs">
    <div class="container-fluid">
        <h3 class="manrope-bold text-[40px] text-[#000] mb-[20px]">Hello Welcome</h3>
        <div class="flex flex-wrap">
            <div class="lg:w-3/6 md:w-3/6 w-full ">
                <div class="semicircle-graph relative">
                    <h3 class="absolute bottom-[-40px] left-[36%] bg-gradient-to-b from-[#6149CD] to-[#DA5C92] text-[16px] text-white rounded-full w-[150px] h-[150px] py-[18px] px-0 text-center alert-shadow border-[20px] border-[#fff] border-solid manrope-semibold">Plant <img src="{{ asset('admin-theme/assets/images/dashboard-down.png')}}" class="mx-auto w-[30px] mt-[10px] "></h3>
                    <div class="multi-graph">
                        <div class="graph" data-name="jQuery"
                            style="--percentage : 100; --fill: #DA5C92 ;">
                            <div id="label" class="label1">100%</div>
                        </div>

                        <div class="graph" data-name="Angular"
                            style="--percentage : 40; --fill: #6149CD ;">
                            <div id="label" class="label2">40%</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="lg:w-3/6 md:w-3/6 w-full ">
                <div class="donut-chart-container">
                    <h3>Monthly Statstic <span>More Stats ></span></h3>
                    <div class="flex flex-wrap">
                        <div class="lg:w-3/6 md:w-3/6 w-full ">
                            <div class="donut-chart">
                                <div class="segment" style="--percentage: 30; --color: #FFB3C1;"></div>
                                <div class="segment" style="--percentage: 40; --color: #9C27B0;"></div>
                                <div class="segment" style="--percentage: 30; --color: #FF9800;"></div>
                            </div>
                        </div>
                        <div class="lg:w-3/6 md:w-3/6 w-full ">
                            <div class="legend">
                                <div class="legend-item">
                                    <span class="legend-color" style="background-color: #FFB3C1;"></span>
                                    Recordings
                                </div>
                                <div class="legend-item">
                                    <span class="legend-color" style="background-color: #9C27B0;"></span>
                                    Screenshots
                                </div>
                                <div class="legend-item">
                                    <span class="legend-color" style="background-color: #FF9800;"></span>
                                    Other works
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="lg:w-3/6 md:w-3/6 w-full mt-[20px]">
                <div class="dashboard-blocks">
                    <div class="flex flex-wrap">
                        <div class="lg:w-3/6 md:w-3/6 w-full ">
                            <div class="dash-box">
                                <img src="{{ asset('admin-theme/assets/images/dash-company.png')}}" class="mx-auto">
                                <p class="text-center">Company</p>
                            </div>
                        </div>
                        <div class="lg:w-3/6 md:w-3/6 w-full ">
                            <div class="dash-box">
                                <img src="{{ asset('admin-theme/assets/images/dash-proj.png')}}" class="mx-auto">
                                <p class="text-center">Project</p>
                            </div>
                        </div>
                        <div class="lg:w-3/6 md:w-3/6 w-full ">
                            <div class="dash-box">
                                <img src="{{ asset('admin-theme/assets/images/dash-device.png')}}" class="mx-auto">
                                <p class="text-center">Devices</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="lg:w-3/6 md:w-3/6 w-full ">
                <div class="bar-chart-container">
                    <div class="header">
                        <h2>Overview</h2>
                        <div class="toggle">
                            <button class="active">This Week</button>
                            <button>Last Week</button>
                        </div>
                    </div>
                    <div class="bar-chart-wrapper">
                        <div class="y-axis">
                            <div class="tick">3000</div>
                            <div class="tick">2000</div>
                            <div class="tick">1000</div>
                            <div class="tick">0</div>
                        </div>
                        <div class="bar-chart">
                            <div class="bar" data-label="Mo" style="--height: 40%;"></div>
                            <div class="bar" data-label="Tu" style="--height: 20%;"></div>
                            <div class="bar" data-label="We" style="--height: 80%;"></div>
                            <div class="bar" data-label="Th" style="--height: 60%;"></div>
                            <div class="bar" data-label="Fr" style="--height: 30%;"></div>
                            <div class="bar" data-label="Sa" style="--height: 50%;"></div>
                            <div class="bar" data-label="Su" style="--height: 40%;"></div>
                        </div>
                    </div>
                    <div class="legend">
                        <div><span class="legend-color new"></span> New</div>
                        <div><span class="legend-color alerts"></span> Alerts</div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection