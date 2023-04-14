<template>
    <Head title="Calendrier" />

    <AuthenticatedLayout>

        <div class="container mx-auto p-4 w-full">
            <div>
                <div class="flex flex-col lg:flex-row justify-between lg:flex-wrap my-5 px-1 lg:px-6 lg:items-center">   
                    <h2 class="text-3xl font-bold mr-6 mb-5 grow ">Calendrier des taches et évènements</h2>
                </div>
            </div>

            <div class=" px-4 mx-auto h-full">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                    <FullCalendar :options="calendarOptions" />
                    
                    <Modal v-show="modalAddEvent" @close="{modalAddEvent = false; EventForm.reset()}">
                        <div class="container text-center ">
                            <form @submit.prevent="addEvent()" class="mx-8">
                                <h4 class="mb-5 text-2xl font-semibold">Nouvel évènement</h4>
                                
                                <BreezeLabel for="Title" value="Titre" class="text-left font-bold text-base mt-4 lg:mt-0 text-zinc-900" />
                                <BreezeInput v-model="EventForm.title" placeholder="Événement 1" id="title" type="text"
                                    class="mt-1 block w-full" required/>

                                <BreezeLabel for="date_start" value="Date de début" class="text-left font-bold text-base mt-4 lg:mt-0 text-zinc-900"/>
                                <BreezeInput v-model="EventForm.date_start" placeholder="Date de début" id="date_start" type="date"
                                    class="mt-1 block w-full" required/>

                                <BreezeLabel for="date_end" value="Date de fin" class="text-left font-bold text-base mt-4 lg:mt-0 text-zinc-900"/>
                                <BreezeInput v-model="EventForm.date_end" placeholder="Date de fin" id="date_end" type="date"
                                    class="mt-1 block w-full" required/>

                                <BreezeLabel for="description" value="Description" class="text-left font-bold text-base mt-4 lg:mt-0 text-zinc-900"/>
                                <textarea v-model="EventForm.description"
                                id="description"
                                class="mt-1 block w-full
                                border-zinc-300 
                                focus:border-amber-400 focus:ring-amber-400 
                                rounded-md shadow-sm"
                                rows="3" />

                                <BreezeLabel for="users" value="Utilisateurs affectés" class="text-left font-bold text-base mt-4 lg:mt-0 text-zinc-900"/>
                                <div>
                                    <VueMultiselect 
                                    v-model="EventForm.users"
                                    :options="options"
                                    :taggable="true"
                                    :multiple="true"
                                    :label="'name'"
                                    :track-by="'id'"
                                    id="users" 
                                    class="mt-1 block w-full" 
                                    @tag="addTag">
                                    </VueMultiselect>
                                </div>

                                <BreezeLabel for="is_urgent" value="Urgent" class="text-left font-bold text-base mt-4 lg:mt-0 text-zinc-900"/>
                                <div class="flex items-center gap-4 mt-1">
                                    <label for="yes">
                                        <input class="border-zinc-300 checked:bg-amber-400 checked:hover:bg-amber-400 focus:bg-amber-400 focus:outline-none focus:ring-1 focus:ring-amber-400 checked:focus:bg-amber-400 checked:active:bg-amber-400 shadow-sm mr-1" 
                                        v-model="EventForm.is_urgent" type="radio" id="yes" name="is_urgent" value="true"
                                        >
                                        Oui
                                    </label>
                                    <label for="no">
                                        <input class="border-zinc-300 checked:bg-amber-400 checked:hover:bg-amber-400 focus:bg-amber-400 focus:outline-none focus:ring-1 focus:ring-amber-400 checked:focus:bg-amber-400 checked:active:bg-amber-400 shadow-sm mr-1" 
                                        v-model="EventForm.is_urgent" type="radio" id="no" name="is_urgent" value="false"
                                        >
                                        Non
                                    </label>
                                </div>



                                <button type="submit" :class="{ 'opacity-25': EventForm.processing }"
                                    :disabled="EventForm.processing"
                                    class="mb-4 mt-8 bg-amber-400 border-amber-400 text-black font-semibold border-4 py-2 w-full hover:bg-amber-300 hover:border-amber-300">
                                    Confirmer
                                </button>
                            </form>
                            <button @click="{modalAddEvent = false; EventForm.reset()}" class="text-red-1 font-semibold">
                                Annuler
                            </button>
                        </div>
                    </Modal>

                    <Modal v-show="modalUpdateEvent" @close="{modalUpdateEvent = false; EventForm.reset()}">
                        <div class="container text-center ">
                            <form @submit.prevent="updateEvent()" class="mx-8">
                                <h4 class="mb-5 text-2xl font-semibold">Modifier un évènement</h4>

                                <BreezeLabel for="Title" value="Titre" class="text-left font-bold text-base mt-4 lg:mt-0 text-zinc-900"/>
                                <BreezeInput v-model="EventForm.title" placeholder="Événement 1" id="title" type="text"
                                    class="mt-1 block w-full" required/>

                                <BreezeLabel for="date_start" value="Date de début" class="text-left font-bold text-base mt-4 lg:mt-0 text-zinc-900"/>
                                <BreezeInput v-model="EventForm.date_start" placeholder="Date de début" id="date_start" type="date"
                                    class="mt-1 block w-full" required/>

                                <BreezeLabel for="date_end" value="Date de fin" class="text-left font-bold text-base mt-4 lg:mt-0 text-zinc-900"/>
                                <BreezeInput v-model="EventForm.date_end" placeholder="Date de fin" id="date_end" type="date"
                                    class="mt-1 block w-full" required/>

                                <BreezeLabel for="description" value="Description" class="text-left font-bold text-base mt-4 lg:mt-0 text-zinc-900"/>
                                <textarea v-model="EventForm.description"
                                id="description"
                                class="mt-1 block w-full
                                border-zinc-300 
                                focus:border-amber-400 focus:ring-amber-400 
                                rounded-md shadow-sm"
                                rows="3" />


                                <BreezeLabel for="users" value="Utilisateurs affectés" class="text-left font-bold text-base mt-4 lg:mt-0 text-zinc-900"/>
                                <div>
                                    <VueMultiselect 
                                    v-model="EventForm.users"
                                    :options="options"
                                    :taggable="true"
                                    :multiple="true"
                                    :label="'name'"
                                    :track-by="'id'"
                                    id="users" 
                                    class="mt-1 block w-full" 
                                    @tag="addTag">
                                    </VueMultiselect>
                                </div>

                                <BreezeLabel for="is_urgent" value="Urgent" class="text-left font-bold text-base mt-4 lg:mt-0 text-zinc-900"/>
                                <div class="flex items-center gap-4 mt-1">
                                    <label for="yes">
                                        <input class="border-zinc-300 checked:bg-amber-400 checked:hover:bg-amber-400 focus:bg-amber-400 focus:outline-none focus:ring-1 focus:ring-amber-400 checked:focus:bg-amber-400 checked:active:bg-amber-400 shadow-sm mr-1" 
                                        v-model="EventForm.is_urgent" type="radio" id="yes" name="is_urgent" value="true"
                                        :checked="EventForm.is_urgent === 1">
                                        Oui
                                    </label>
                                    <label for="no">
                                        <input class="border-zinc-300 checked:bg-amber-400 checked:hover:bg-amber-400 focus:bg-amber-400 focus:outline-none focus:ring-1 focus:ring-amber-400 checked:focus:bg-amber-400 checked:active:bg-amber-400 shadow-sm mr-1" 
                                        v-model="EventForm.is_urgent" type="radio" id="no" name="is_urgent" value="false"
                                        :checked="EventForm.is_urgent === 0">
                                        Non
                                    </label>
                                </div>

                                <div class="flex mt-8 mb-6 gap-8">
                                    <button type="submit" :class="{ 'opacity-25': EventForm.processing }"
                                        :disabled="EventForm.processing"
                                        class=" bg-amber-400 border-amber-400 text-black font-semibold border-4 py-2 w-full hover:bg-amber-300 hover:border-amber-300">
                                        Modifier
                                    </button>
                                    <button :class="{ 'opacity-25': EventForm.processing }"
                                        type="button"
                                        :disabled="EventForm.processing"
                                        @click="deleteEvent()"
                                        class="bg-red-400 border-red-400 text-black font-semibold border-4 py-2 w-full hover:bg-red-300 hover:border-red-300">
                                        Supprimer
                                    </button>
                                </div>
                            </form>
                            <button @click="{modalUpdateEvent = false; EventForm.reset()}" class="text-red-1 font-semibold">
                                Annuler
                            </button>
                        </div>
                    </Modal>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';
import Modal from "@/Components/Modal.vue";
import { useForm } from "@inertiajs/inertia-vue3";
import Swal from 'sweetalert2';
import tippy from 'tippy.js';
import 'tippy.js/dist/tippy.css';
import 'tippy.js/themes/light-border.css';


import BreezeLabel from "@/Components/InputLabel.vue";
import BreezeInput from "@/Components/TextInput.vue";
import VueMultiselect from 'vue-multiselect';

import FullCalendar from '@fullcalendar/vue3';
import dayGridPlugin from '@fullcalendar/daygrid';
import interactionPlugin from '@fullcalendar/interaction';
import frLocale from '@fullcalendar/core/locales/fr';

export default {
    components: {
        AuthenticatedLayout,
        Head,
        FullCalendar,
        Modal,
        BreezeLabel,
        BreezeInput,
        VueMultiselect,
    },
    props: ['events', 'users'],
    data(props) {
        return {
            modalAddEvent: false,
            modalUpdateEvent: false,
            options: props.users,
            EventForm: useForm({
                id: null,
                title: null,
                date_start: null,
                date_end: null,
                description: null,
                is_urgent: false,
                users: [],
            }),

            calendarOptions: {
                locale: frLocale,
                plugins: [dayGridPlugin, interactionPlugin],
                initialView: 'dayGridMonth',
                selectable: true,
                events: this.events,
                headerToolbar: {
                    center: 'addEventButton'
                },
                select : function(arg) {
                    console.log(arg);
                    this.EventForm.date_start = arg.startStr;
                    this.EventForm.date_end = arg.endStr;
                }.bind(this),

                eventClick: function(info) {
                    console.log(info.event);
                    this.modalUpdateEvent = true;
                    this.EventForm.id = info.event.id;
                    this.EventForm.title = info.event.title;
                    this.EventForm.date_start = info.event.startStr;
                    this.EventForm.date_end = info.event.endStr;
                    this.EventForm.description = info.event.extendedProps.description;
                    this.EventForm.is_urgent = info.event.extendedProps.is_urgent;

                    this.EventForm.users = info.event.extendedProps.users;
                    console.log(this.EventForm.users);
                }.bind(this),
                eventDidMount: function(info) {
                    if (info.event.extendedProps.is_urgent) {
                        info.el.style.backgroundColor = '#f87171';
                        info.el.style.borderColor = '#f87171';
                        info.el.style.textColor = '#fff';
                    } else {
                        info.el.style.backgroundColor = '#FBBF5D';
                        info.el.style.borderColor = '#FBBF5D';
                        info.el.style.textColor = '#000';
                    }
                    //if event users contains auth user id then add class
                    if (info.event.extendedProps.users.find(user => user.id === this.$page.props.auth.user.id)) {
                        //DO SMTH
                    }

                    //append description to event
                    
                    info.el.querySelector('.fc-event-title').classList.add('text-base');
                    info.el.querySelector('.fc-event-title-container').classList.add('px-1', 'cursor-pointer');
                    //if description is null dont add it
                    if (info.event.extendedProps.description) {
                        info.el.querySelector('.fc-event-title-container').innerHTML += '<div class="text-sm truncate">' + info.event.extendedProps.description + '</div>';
                    }
                    //info.el.querySelector('.fc-event-title')

                    //add tooltip
                    tippy(info.el, {
                        //content is html so we have description and user names as list, show description if not null
                        content: info.event.extendedProps.description !== null ?
                            '<div class="text-sm">' 
                            + info.event.extendedProps.description 
                            + '</div>' 
                            + '<div class="text-xs mt-2"><span class="text-sm">Participants : </span> ' 
                            + info.event.extendedProps.users.map(user => user.name).join(', ') 
                            + '</div>' : 

                            '<div class="text-xs mt-2"><span class="text-sm">Participants : </span> ' 
                            + info.event.extendedProps.users.map(user => user.name).join(', ') 
                            + '</div>',
                        allowHTML: true,
                        theme: 'light-border',
                        placement: 'top',
                        arrow: true,
                        animation: 'fade',
                        maxWidth: 300,
                        trigger: 'mouseenter',
                        hideOnClick: false,
                        onMount(instance) {
                            //make text auto wrap
                           // TODO
                        },
                    });
                }.bind(this),
                customButtons: {
                    addEventButton: {
                        text: 'Ajouter un évènement',
                        //on click get selected values and open the modal
                        click: function() {
                            this.modalAddEvent = true;
                        }.bind(this)
                    }
                },
            },
        };
    },
    methods: {
        addEvent() {
            //Verify that the start date is before the end date
            this.EventForm.users = this.EventForm.users.map(user => user.id);
            this.EventForm.is_urgent = this.EventForm.is_urgent ? 1 : 0;
            if (this.EventForm.date_start > this.EventForm.date_end) {
                Swal.fire({
                    icon: 'error',
                    title: 'Erreur',
                    text: 'La date de début doit être antérieure à la date de fin',
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 1750,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })
                //empty end date
                this.EventForm.date_end = null;
                return;
            }
            this.EventForm.post(route('events.store'), {
                preserveScroll: true,
                preserveState: false,
                onSuccess() {
                    console.log('success');
                    Swal.fire({
                        icon: 'success',
                        title: 'Évènement ajouté avec succès',
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
            });
        },
        updateEvent() {
            //Verify that the start date is before the end date
            //take only users ids
            this.EventForm.users = this.EventForm.users.map(user => user.id);
            this.EventForm.is_urgent = this.EventForm.is_urgent ? 1 : 0;
            if (this.EventForm.date_start > this.EventForm.date_end) {
                Swal.fire({
                    icon: 'error',
                    title: 'Erreur',
                    text: 'La date de début doit être antérieure à la date de fin',
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 1750,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })
                //empty end date
                this.EventForm.date_end = null;
                return;
            }
            this.EventForm.put(route('events.update', this.EventForm.id), {
                preserveScroll: true,
                preserveState: false,
                onSuccess() {
                    console.log('success');
                    Swal.fire({
                        icon: 'success',
                        title: 'Évènement modifié avec succès',
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
            });
        },
        deleteEvent() {
            Swal.fire({
                title: "Voulez-vous vraiment supprimer cet événement ?",
                text: "Cette action est irréversible.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d93131',
                confirmButtonText: "Confirmer",
                cancelButtonText: "Annuler"
            }) .then((result) => {
                if (result.isConfirmed) {
                    console.log('ON EST EN TRAIN DE SUPPRIMER')
                    this.EventForm.delete(route('events.destroy', this.EventForm.id), {
                        preserveScroll: true,
                        preserveState: false,
                        onSuccess() {
                            console.log('success');
                            Swal.fire({
                                icon: 'success',
                                title: 'Évènement supprimé avec succès',
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
                    });
                }
            })
            
        },
        addTag (newTag) {
            const tag = {
                name: newTag,
                code: newTag.substring(0, 2) + Math.floor((Math.random() * 10000000))
            }
            this.options.push(tag)
            this.value.push(tag)
        },
    },
    mounted() {
        
        console.log(this.events);
    },
};
</script>
<style src="vue-multiselect/dist/vue-multiselect.css"></style>
