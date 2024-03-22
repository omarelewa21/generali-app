<?php
/**
 * Navbar Section for Right Progress Navigation
 */
?>
@php
    use Illuminate\Support\Facades\Request;
 
    $customerDetails = Request::session()->get('customer_details', []);
    $medicalSelection = isset($customerDetails['selected_needs']['need_6']['advance_details']) ? $customerDetails['selected_needs']['need_6']['advance_details'] : null;
 
    function getProgressRecursive($timeline, $array, $medicalSelection, $searchItem, &$progress = null) {
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                getProgressRecursive($timeline, $value, $medicalSelection, $searchItem, $progress);
            } elseif ($value === $searchItem) {
                $index = $key + 1;
                $total = count($array);
 
                if ($searchItem == 'health-medical/medical-selection') {
                    if (isset($medicalSelection["critical_illness"]) && isset($medicalSelection["health_care"])) {
                        $total = count($timeline["health-medical"][1]) + count($timeline["health-medical"][2]) + 1;
                    } else {
                        $total = count($array[$key+1])+1;
                    }
                } else if (strpos($searchItem, 'health-medical') === 0) {
                    if (isset($medicalSelection["critical_illness"]) && isset($medicalSelection["health_care"])) {
                        $total = count($timeline["health-medical"][1]) + count($timeline["health-medical"][2]) + 1;
                        if (strpos($searchItem, 'health-medical/critical-illness') === 0) {
                            $index += 1;
                        } else {
                            $index += 1 + count($timeline["health-medical"][2]);
                        }
                    } else {
                        $index += 1;
                        $total += 1;
                    }
                }
 
                $progress = ($index / $total) * 360;
 
                return;
            }
        }
    }
 
    $timelineProgress = [
        'protection' => [
            'protection',
            'protection/coverage',
            'protection/amount-needed',
            'protection/existing-policy',
            'protection/gap'
        ],
        'retirement' => [
            'retirement',
            'retirement/coverage',
            'retirement/ideal',
            'retirement/monthly-support',
            'retirement/period',
            'retirement/allocated-funds',
            'retirement/gap'
        ],
        'education' => [
            'education',
            'education/coverage',
            'education/amount-needed',
            'education/existing-fund',
            'education/gap'
        ],
        'savings' => [
            'savings',
            'savings/coverage',
            'savings/goals',
            'savings/amount-needed',
            'savings/annual-return',
            'risk-profile',
            'savings/gap'
        ],
        'investment' => [
            'investment',
            'investment/coverage',
            'investment/amount-needed',
            'investment/annual-return',
            'risk-profile',
            'investment/gap'
        ],
        'health-medical' => [
            'health-medical',
            'health-medical/medical-selection',
            [
                'health-medical/medical-planning/coverage',
                'health-medical/medical-planning/hospital-selection',
                'health-medical/medical-planning/room-selection',
                'health-medical/medical-planning/amount-needed',
                'health-medical/medical-planning/existing-care',
                'health-medical/medical-planning/gap'
            ],
            [
                'health-medical/critical-illness/coverage',
                'health-medical/critical-illness/amount-needed',
                'health-medical/critical-illness/existing-care',
                'health-medical/critical-illness/gap'
            ]
        ],
        'debt-cancellation' => [
            'debt-cancellation',
            'debt-cancellation/coverage',
            'debt-cancellation/amount-needed',
            'debt-cancellation/existing-debt',
            'debt-cancellation/critical-illness',
            'debt-cancellation/gap'
        ],
    ];
 
 
    $progress = null;
getProgressRecursive($timelineProgress, $timelineProgress, $medicalSelection, Request::path(), $progress);
@endphp
 
{{-- Links for Needs Sidebar Right --}}
@include('templates.nav.nav-sidebar-links-needs')
{{-- Links for Needs Sidebar Right --}}

{{-- Nav Sidebar Right Needs --}}

<section class="d-flex justify-content-end pt-2 pt-md-0">
    <div class="row align-items-center px-4 py-md-4 py-3">
        <div class="col-auto pe-0">
            <a data-bs-toggle="offcanvas" href="#offcanvasNeeds" role="button" aria-controls="offcanvasNeeds" class="text-decoration-none">
                <p class="display-6 text-dark m-1 needs-progress">
                    @php
                        // Get the current route name
                        $routeName = Route::currentRouteName();
                        // Extract the folder name from the route name (assuming folder names are
                        //separated by '.')
                        $folderName = explode('.', $routeName)[0];
                    @endphp 
                    {{ ($folderName == 'savings') ? 'Regular Savings' : (($folderName == 'investment') ? 'Lump Sum Investment' : (($folderName == 'health') ? 'Health & Medical' : (($folderName == 'debt') ? 'Debt Cancellation' : ucfirst($folderName)))) }}
                    <!-- Display the folder name with the first letter in uppercase -->
                </p>
            </a>
        </div>
        <div class="col-auto pe-sm-0 ps-0">
            <a data-bs-toggle="offcanvas" href="#offcanvasNeeds" role="button" aria-controls="offcanvasMenu" class="d-flex align-items-center">
                @php
                    $folderNumber = [
                        'protection' => 1,
                        'retirement' => 2,
                        'education' => 3,
                        'savings' => 4,
                        'investment' => 5,
                        'health' => 6,
                        'debt' => 7,
                        // 'Others' => 8,
                    ];
                    $dynamicNumber = $folderNumber[$folderName] ?? 0;
                @endphp
                <div class="progress mx-2">
                    <span class="progress-value">
                        <p class="mb-0">{{ $dynamicNumber }}</p>
                    </span>
                    <div class="overlay"></div>
                    <div class="left"></div>
                    <div class="right"></div>
                </div>
            </a>
        </div>
    </div>
</section>

<style>
    /* code for progress bar css */
    @if($progress != null)
        @if($progress > 180)
            .progress .left {
                z-index:1;
                transform: rotate(180deg);
            }
            .progress .right {
                z-index:2;
                transform: rotate({{ $progress }}deg);
            }
        @else
            .progress .left {
                z-index:1;
                transform: rotate({{ $progress }}deg);
            }
        @endif
    @endif
</style>