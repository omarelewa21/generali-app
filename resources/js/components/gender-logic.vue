<template>

  <button  v-on:click="say">Say what</button>

</template>

<script>
  export default {
      mounted() {
          console.log('Component mounted.')
      },

// define methods under the `methods` object
methods: {
  say: function (event) {
    // `this` inside methods points to the Vue instance
    alert('Hello ')
    // `event` is the native DOM event
    if (event) {
      alert(event.target.tagName + " Clicked ")
    }
  }
}
  }
</script>