<template>
    <div class="list-card
    bg-white rounded-lg flex items-center
    border-solid border-zinc-300 border-1 px-6 py-3
    w-full justify-between">
      <div class="texts flex flex-col lg:felx-row items-start">
        <p class="title mb-1 font-normal text-md">Pots de {{ honey_jar.size }}</p>
        <p class="subtitle font-semibold text-xl text-amber-400">{{ honey_jar.nb_jar }}</p>
      </div>
      <div class="flex justify-between gap-2">
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