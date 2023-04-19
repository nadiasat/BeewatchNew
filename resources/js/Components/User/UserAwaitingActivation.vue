<template>
    <div class="flex items-center mb-4">
        <h4 class="w-full sm:w-96 font-bold text-xl">En attente d'activation</h4>
        <hr class="w-0 sm:w-full">
    </div>
    <div v-if="!usersAwaitingActivation.length">
        Aucun utilisateur en attente d'activation
    </div>
    <div v-else class="border rounded-xl overflow-x-auto">
        <table class="table-auto text-sm lg:text-base w-full"
        id="users-awating-activation">
            <thead>
                <tr class="bg-[#AFAC99] divide-x divide-[#99978C]">
                    <th class="
                    p-2 pl-4 pt-2 pb-2
                    lg:p-4 lg:pl-8 lg:pt-4 lg:pb-4 
                    text-zinc-900 text-left"
                    >Nom et prénom</th>
                    <th class="
                    p-2 pl-4 pt-2 pb-2
                    lg:p-4 lg:pl-8 lg:pt-4 lg:pb-4 
                    text-zinc-900 text-left">Email</th>
                    <th class="
                    p-2 pl-4 pt-2 pb-2
                    lg:p-4 lg:pl-8 lg:pt-4 lg:pb-4 
                    text-zinc-900 text-left">Clé d'activation</th>
                    <th class="
                    p-2 pl-4 pt-2 pb-2
                    lg:p-4 lg:pl-8 lg:pt-4 lg:pb-4 
                    text-zinc-900 text-left">Rôle</th>
                    <th class="
                    p-2 pl-4 pt-2 pb-2
                    lg:p-4 lg:pl-8 lg:pt-4 lg:pb-4 
                    text-zinc-900 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(user, index) in usersAwaitingActivation" :class="index % 2 === 0 ? 'bg-white' : 'bg-[#F5F3E7]'" class="divide-x divide-[#E0DDCE]">
                    <td class="
                    p-2 pl-4 
                    lg:p-4 lg:pl-8 
                    text-zinc-900"
                    :id='user.lastname + " " + user.firstname'
                    >{{ user.lastname + " " + user.firstname}}</td>
                    <td class="
                    p-2 pl-4 
                    lg:p-4 lg:pl-8  
                    text-zinc-900"
                    :id='user.email'>{{ user.email }}</td>
                    <td class="
                    p-2 pl-4 
                    lg:p-4 lg:pl-8  
                    text-zinc-900"
                    >{{ user.activation_key }}</td>
                    <td class="
                    p-2 pl-4 
                    lg:p-4 lg:pl-8  
                    text-zinc-900">{{ user.role }}</td>
                    <td class="
                    p-2 pl-4 
                    lg:p-4 lg:pl-8  
                    -zinc-900
                    flex justify-center">
                        <UserEdit :user="user" :apiaries="apiaries"></UserEdit>
                        <UserDelete :user_id="user.id"></UserDelete>
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
    name: "UserAwaitingActivation",
    props: ['usersAwaitingActivation', 'apiaries'],
    components: { UserDelete, UserEdit },
    mounted() {
        console.log(this.usersAwaitingActivation);
    }
}
</script>

<style scoped>

</style>
