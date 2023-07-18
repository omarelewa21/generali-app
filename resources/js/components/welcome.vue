<template>
      <img :src="homeVector" width="30%" alt="Footer Vector">
      <img :src="welcomeAvatar" :style="{ width: `calc(100vh - 60px)` }" alt="Footer Vector">
  </template>
  
  <script>
  export default {
    data() {
      return {
        homeVector: "/images/welcome-page/home-vector.png",
        welcomeAvatar: "/images/welcome-page/welcome-avatar.png"
      }
    }
  }
  </script>
  