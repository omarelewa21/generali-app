<!-- ExampleComponent.vue -->
<template>
  <div>
    <button @click="handleClick">Click Me</button>
  </div>
</template>

<script>
export default {
  methods: {
    handleClick() {
      // Perform your desired action here
      console.log('Button clicked!');
    }
  }
}
</script>
