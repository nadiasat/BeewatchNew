<template>
    <form @submit.prevent="deleteUser" @click="user_id = user.id">
        <button type="submit" class="flex items-center rounded-xl text-sm border-2 border-red-600 px-2 py-2 text-red-600 font-semibold mr-3 hover:bg-red-600 hover:text-white">
            <svg class="fill-current mr-1" width="12" height="14" viewBox="0 0 12 12"
                fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M5.57146 0H4.4286V1H1L0.5 2H9.50003L9 1H5.57146V0Z" />
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M1.00003 2.5H9.00003L7.85718 10H2.14289L1.00003 2.5ZM2.7485 4.24756C2.72646 4.11084 2.58206 4.01556 2.42581 4.03473C2.26956 4.05396 2.16061 4.18036 2.18251 4.31708L2.83667 8.39484C2.85857 8.53162 3.0031 8.62689 3.15935 8.60767C3.3156 8.5885 3.42442 8.4621 3.40252 8.32538L2.7485 4.24756ZM5.00003 4C5.15782 4 5.28575 4.11194 5.28575 4.25V8.36774C5.28575 8.50586 5.15782 8.61774 5.00003 8.61774C4.84225 8.61774 4.71432 8.50586 4.71432 8.36774V4.25C4.71432 4.11194 4.84225 4 5.00003 4ZM7.24599 4.24756C7.26803 4.11084 7.41242 4.01556 7.56867 4.03473C7.72492 4.05396 7.83388 4.18036 7.81197 4.31708L7.15782 8.39484C7.13591 8.53162 6.99138 8.62689 6.83513 8.60767C6.67888 8.5885 6.57007 8.4621 6.59197 8.32538L7.24599 4.24756Z" />
            </svg>
        </button>                         
    </form>

</template>

<script>
import Swal from "sweetalert2";
import { useForm } from "@inertiajs/inertia-vue3";

export default {
    name: "UserActivated",
    props: ['user_id'],
    methods: {
        deleteUser() {
            Swal.fire({
                title: "Voulez-vous vraiment supprimer cet utilisateur ?",
                text: "Cette action est irréversible.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d93131',
                confirmButtonText: "Confirmer",
                cancelButtonText: "Annuler"
            }).then((result) => {
                if (result.isConfirmed) {
                    useForm({}).delete(route('users.destroy', this.user_id), {
                        onSuccess() {
                            Swal.fire({
                                icon: 'success',
                                title: 'Utilisateur supprimé avec succès',
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
                    })
                }
            })
        }
    },
    mounted() {
        console.log(this.usersActivated)
    }
}
</script>