<template>
    <transition name="fade">
      <div class="w-full h-screen fixed left-0 top-0 z-20">
        <div class="bg-black-1 z-30 bg-opacity-60 overflow-hidden h-screen"
             @click="close"></div>
        <div class="w-full max-w-xl overflow-y-auto max-h-full py-10 absolute z-40 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
          <div class="bg-gray-50 mx-3 relative rounded-lg" style="min-height: 150px">
            <button @click="close" class="absolute h-8 w-8 right-4 top-3 bg-green-1 rounded-full hover:bg-green-2 ">
              <svg class="h-6 w-6 m-auto" stroke="white" fill="white" viewBox="0 0 24 24" @click="close">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
              </svg>
            </button>
            <div class="pt-6 pb-10">
              <slot></slot>
            </div>
          </div>
        </div>
      </div>
    </transition>
  </template>
  
  <script>
  
  export default {
      emits: ['close'],
  
      methods: {
          close() {
              this.$emit('close');
          }
      }
  }
  </script>
  
  <style scoped>
  .fade-enter-active,
  .fade-leave-active {
    transition: opacity 0.3s ease;
  }
  
  .fade-enter-from,
  .fade-leave-to {
    opacity: 0;
  }
  </style>