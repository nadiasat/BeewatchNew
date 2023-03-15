<template>
    <div class="flex items-center mb-4">
        <h4 class="w-full sm:w-96 font-bold text-xl">Activés</h4>
        <hr class="w-0 sm:w-full">
    </div>
    <div v-if="!usersActivated.length">
        Aucun utilisateur activé
    </div>
    <div v-else class="border rounded-xl overflow-x-scroll">
        <table calss="table-auto text-sm">
            <thead>
                <tr class="bg-amber-400 divide-x divide-[#C69202]">
                    <th class="p-4 pl-8 pt-4 pb-4 text-zinc-900 text-left">Nom et prénom</th>
                    <th class="p-4 pl-8 pt-4 pb-4 text-zinc-900 text-left">Email</th>
                    <th class="p-4 pl-8 pt-4 pb-4 text-zinc-900 text-left">Rôle</th>
                    <th class="p-4 pl-8 pt-3 pb-4 text-zinc-900 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(user, index) in usersActivated" :class="index % 2 === 0 ? 'bg-white' : 'bg-amber-100/50'" class="divide-x divide-[#E0DDCE]">
                    <td class="p-4 pl-8 text-zinc-900">{{ user.lastname + " " + user.firstname}}</td>
                    <td class="p-4 pl-8 text-zinc-900">{{ user.email }}</td>
                    <td class="p-4 pl-8 text-zinc-900">{{ user.role }}</td>
                    <td class="p-4 pl-8 text-zinc-900">
                        <UserDelete :user_id="user.id"></UserDelete>
                        <!-- User edit component pass user and apiaries-->
                        <UserEdit :user="user" :apiaries="apiaries"></UserEdit>
                        
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import UserDelete from "./UserDelete.vue";
import UserEdit from "./UserEdit.vue";

export default {
    name: "UserActivated",
    props: ["usersActivated", "apiaries"],
    mounted() {
        console.log(this.usersActivated);
    },
    components: { UserDelete, UserEdit }
}
</script>

<style scoped>

</style>
