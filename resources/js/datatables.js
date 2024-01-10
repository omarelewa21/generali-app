import DataTable from 'datatables.net-bs5';
import 'datatables.net-buttons-dt';
import 'datatables.net-responsive-bs5';
import 'datatables.net-select-bs5';
import 'datatables.net-searchbuilder-bs5';
import 'datatables.net-datetime';
import moment from 'moment';

const specificPageURLs = [
    '/agent/logs',
    '/agent',
];

const currentURL = window.location.href;

if (specificPageURLs.some(url => currentURL.endsWith(url))) {
    var siteurl = window.location.href;
    const url = new URL(siteurl);
    const path = url.pathname;

//     if (path == '/agent/logs') {
//         // Declare Datatables for sorting
//         document.addEventListener('DOMContentLoaded', function () {
// //             var buttonHTML = '<button id="buttonAdvanced" class="btn btn-secondary fw-bold btn-sm">Advanced Search</button>';
// //             // Append the button to the DataTable's top section
// //             $('#dataTable_wrapper div.top .dt-buttons').append(buttonHTML);
// // console.log($('#dataTable_wrapper'));
//             var table = $('#dataTable').DataTable({
//                 language: {
//                     search: `<svg width="18" height="18" class="w-4 lg:w-auto" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
//                         <path d="M8.11086 15.2217C12.0381 15.2217 15.2217 12.0381 15.2217 8.11086C15.2217 4.18364 12.0381 1 8.11086 1C4.18364 1 1 4.18364 1 8.11086C1 12.0381 4.18364 15.2217 8.11086 15.2217Z" stroke="#455A64" stroke-linecap="round" stroke-linejoin="round"></path>
//                         <path d="M16.9993 16.9993L13.1328 13.1328" stroke="#455A64" stroke-linecap="round" stroke-linejoin="round"></path>
//                     </svg>`,
//                     searchPlaceholder: 'Search...',
//                 },
//                 dom: 'rt<"bottom"ip>',
//                 // buttons: [{
//                 //     text: 'Advanced Search',
//                 //     className: 'btn btn-secondary fw-bold btn-sm',
//                 //     attr: {
//                 //         id: 'buttonAdvanced'
//                 //     },
//                 //     action: function () {
//                 //         jQuery.noConflict();
//                 //         $('#advancedSearch').modal('show');
//                 //     }
//                 // }],
//                 search: {
//                     return: true
//                 },
//                 responsive: false,
//                 autoWidth: true,
//                 scrollCollapse: true,
//                 scrollY: false,
//                 scrollX: '1054px',
//                 columnDefs: [
//                     { width: '15%', targets: 0, searchBuilder: {defaultCondition: '='}},
//                     { width: '18%', targets: 1, searchBuilder: {defaultCondition: '='}},
//                     { width: '19%', targets: 2, searchBuilder: {defaultCondition: '='}},
//                     { width: '12%', targets: 3 },
//                     { width: '14%', targets: 4 },
//                     { width: '13%', targets: 5 },
//                     { width: '20%', targets: 6, orderable: false },
//                 ],
//                 initComplete: function () {
//                     var tableWidth = $('.dataTables_scrollHeadInner');
//                     var dataTable = $('.dataTables_scrollHeadInner .dataTable');
//                     var tableBody = $('.dataTables_scrollBody .dataTable');

//                     tableWidth.css('min-width', '1054px');
//                     dataTable.css('min-width', '1054px');
//                     tableBody.css('min-width', '1054px');
//                 },
//             });

//             $('#submitButton').on('click', function() {
//                 var transactionValue = $('#searchTransaction').val();
//                 var nameValue = $('#searchName').val();
//                 var idValue = $('#searchID').val();
//                 var statusValue = $('#searchStatus').val();

//                 table.column(0).search(transactionValue);
//                 table.column(1).search(nameValue);
//                 table.column(2).search(idValue);
//                 table.column(3).search(statusValue);

//                 table.draw();
//             });

//             // Populate select options based on DataTable data
//             var uniqueValues = function(columnIndex) {
//                 return table
//                 .column(columnIndex)
//                 .data()
//                 .unique()
//                 .sort()
//                 .each(function(value) {
//                     $('#searchStatus').append($('<option>', {
//                         value: value,
//                         text: value
//                     }));
//                 });
//             };
//             uniqueValues(3);
        
//             // Custom filtering function which will search data in column four between two values
//             let minDate, maxDate;
//             DataTable.ext.search.push(function (settings, data, dataIndex) {
//                 let min = minDate.val();
//                 let max = maxDate.val();
//                 let date = new Date(data[4]);
            
//                 if (
//                     (min === null && max === null) ||
//                     (min === null && date <= max) ||
//                     (min <= date && max === null) ||
//                     (min <= date && date <= max)
//                 ) {
//                     return true;
//                 }
//                 return false;
//             });
            
//             // Create date inputs
//             function initializeMinMax() {
//                 minDate = new DateTime('#min', {
//                     format: 'YYYY-MM-DD'
//                 });
//                 maxDate = new DateTime('#max', {
//                     format: 'YYYY-MM-DD'
//                 });
//             }
            
//             initializeMinMax();
            
//             // Refilter the table
//             document.querySelectorAll('#min, #max').forEach((el) => {
//                 el.addEventListener('change', () => table.draw());
//             });

//             $(document).on('click', '#resetButton', function () {
//                 document.getElementById('searchTransaction').value = '';
//                 document.getElementById('searchName').value = '';
//                 document.getElementById('searchID').value = '';
//                 document.getElementById('searchStatus').value = '';

//                 $("#min").val('');
//                 $("#max").val('');
//                 initializeMinMax();
//                 table.draw();
//             });
//         });
//     }

    // if (path == '/agent') {
    //     // Declare Datatables for sorting
    //     $(document).ready(function () {
    //         // Datatables for Agent Dashboard
    //         $('#agentTable').DataTable({
    //             responsive: false,
    //             autoWidth: true,
    //             paging: true,
    //             searching: false,
    //             ordering: true,
    //             lengthChange: false,
    //             pageLength: 10,
    //             columnDefs: [
    //                 { width: '15%', targets: 0 },
    //                 { width: '26%', targets: 1 },
    //                 { width: '19%', targets: 2 },
    //                 { width: '20%', targets: 3 },
    //                 { width: '13%', targets: 4, orderable: false },
    //                 { width: '7%', targets: 5, orderable: false },
    //             ],
    //             scrollCollapse: true,
    //             scrollY: false,
    //             scrollX: '1054px',
    //             initComplete: function () {
    //                 // var table = this.api();
    //                 var container = $('#agentTable_wrapper');
    //                 var tableWidth = $('.dataTables_scrollHeadInner');
    //                 var dataTable = $('.dataTables_scrollHeadInner .dataTable');
    //                 var tableBody = $('.dataTables_scrollBody .dataTable');

    //                 tableWidth.css('min-width', '1054px');
    //                 dataTable.css('min-width', '1054px');
    //                 tableBody.css('min-width', '1054px');
    //             }
    //         });
    //     });
    // }
}