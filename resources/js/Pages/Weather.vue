<template>
 <BreezeAuthenticatedLayout>
        <div class="container mx-auto p-4">

          {{ weather }}

        </div>
    </BreezeAuthenticatedLayout>

</template>

<script>

export default {
    name: "Weather",
    props: ["weather"],
    components: {
    },
    
    mounted() {
    
        //console.log(this.weather);
    },
    };

</script>
