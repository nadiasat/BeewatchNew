<template>
    <div v-if="hasErrors">
        <ul class="mt-3 list-disc list-inside text-sm text-red-1">
            <li v-for="(error, key) in errors" :key="key">{{ error }}</li>
        </ul>
    </div>
</template>

<script lang="ts">
import Swal from "sweetalert2";

export default {
    computed: {
        errors() {
            return this.$page.props.errors
        },

        hasErrors() {
            let errors =  Object.keys(this.errors).length > 0
            if (errors) {
                //foreach error, display a sweetalert
                for (const [key, value] of Object.entries(this.errors)) {
                    Swal.fire({
                        icon: 'error',
                        //title is the error
                        title: value,
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3500,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })
                }
            }
        },
    }
}
</script>
