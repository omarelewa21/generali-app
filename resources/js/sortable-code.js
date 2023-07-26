import Sortable from 'sortablejs';
// Default SortableJS


const rightContainer = document.getElementById('right-container');
// var rightContainer = document.querySelector('#right-container .draggable');
console.log(rightContainer);
const leftContainer = document.getElementById('left-container');

// Sortable options for the right container (draggable items)
var sortable = Sortable.create(rightContainer, {
  group: {
    name: "shared",
    pull: "clone",
    put: false, // Do not allow items to be put into this list
  },
  animation: 150,
});

// Sortable options for the left container (drop target)
var sortable2 = Sortable.create(leftContainer, {
  group: "shared",
  animation: 150,

});



// var animation = bodymovin.loadAnimation({
//     container: document.getElementById('bm'),
//     renderer: 'svg',
//     loop: true,
//     autoplay: true,
//     path: '/images/data.json'
//   })