<template>
    <div class="list-card
    bg-white rounded-lg flex flex-col lg:row 
    items-center gap-2
    border-solid border-zinc-300 border-1 px-6 py-3
    w-full justify-between">
      <div class="texts flex flex-col lg:felx-row items-start w-full">
        <p class="title mb-1 font-normal text-sm lg:text-base w-full">Pots de {{ honey_jar.size }}</p>
        <p class="subtitle font-semibold text-xl text-amber-400">{{ honey_jar.nb_jar }}</p>
      </div>
      <div class="flex justify-center w-full gap-2">
        <HoneyJarsEdit :honey_jar="honey_jar"></HoneyJarsEdit>
        <HoneyJarsEdit :honey_jar="honey_jar"></HoneyJarsEdit>
      </div>
    </div>
  </template>
  
  <script>

  import HoneyJarsEdit from './HoneyJarsEdit.vue';

  export default {
    name: "HoneyJarCard",
    props: ["honey_jar"],
    components: {
      HoneyJarsEdit,
    },

    mounted() {

      //console.log(this.honey_jar);
    },
  };
  </script>