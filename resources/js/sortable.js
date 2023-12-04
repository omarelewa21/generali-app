import Sortable from 'sortablejs';

// sort: true
Sortable.create(sortTrue, {
    group: "sorting",
    sort: true
  });
  
  // sort: false
  Sortable.create(sortFalse, {
    group: "sorting",
    sort: false
  });
  
// document.addEventListener('DOMContentLoaded', function() {
//     const sortableList1 = document.getElementById('sortable-list-1');
//     const sortableList2 = document.getElementById('sortable-list-2');
  
//     new Sortable(sortableList1, {
//         group: 'shared', // Set a group name for the first list
//         // handle: '.drag-handle',
//         // animation: 150,
//     });
  
//     new Sortable(sortableList2, {
//         group: 'shared', // Set the same group name for the second list
//         handle: '.drag-handle',
//         animation: 150,
//     });
// });

//     // document.addEventListener('DOMContentLoaded', function () {
//     //     // Initialize Sortable on both lists
//     //     var sortableList1 = new Sortable(document.getElementById('sortable-list-1'), {
//     //         group: 'shared', // Set a shared group name to allow dragging between lists
//     //         animation: 150, // Animation duration in milliseconds
//     //         easing: 'cubic-bezier(1, 0, 0, 1)', // Animation easing function
//     //     });

//     //     var sortableList2 = new Sortable(document.getElementById('sortable-list-2'), {
//     //         group: 'shared', // Set a shared group name to allow dragging between lists
//     //         animation: 150, // Animation duration in milliseconds
//     //         easing: 'cubic-bezier(1, 0, 0, 1)', // Animation easing function
//     //     });
//     // });

// // Initialize Sortable for both lists
// const list1 = new Sortable(document.getElementById('sortable-list-1'), {
//     group: 'shared',
//     animation: 150,
// });

// const list2 = new Sortable(document.getElementById('sortable-list-2'), {
//     group: 'shared',
//     animation: 150,
// });