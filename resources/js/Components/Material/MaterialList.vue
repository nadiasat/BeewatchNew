<template>
    <div class="flex flex-col lg:flex-row items-left lg:items-center mb-4">
        <h4 class="w-full sm:w-96 font-bold text-xl shrink">Lieu de stockage</h4>
            
        <div class="w-full flex mt-4 lg:mt-0">
            <InventoryPlaceEdit v-if="childNMounted"
            v-bind="inventoryPlaceProps"></InventoryPlaceEdit>
            <select @change="changeMaterials()"
            class="w-full rounded-xl border border-gray-300 p-2" name="inventory_place_id" id="inventory_place_id">
                <option v-for="inventory_place in inventory_places" :value="inventory_place.id">{{ inventory_place.name }}</option>
            </select>
        </div>

    </div>
    <hr>
    <div class="flex flex-col lg:flex-row items-center my-4 gap-2 lg:gap-4">
        <InventoryPlaceCreate></InventoryPlaceCreate>
        <MaterialCreate v-if="childNMounted"
        v-bind="inventoryPlaceProps"></MaterialCreate>
    </div>

    <hr>

    <div v-if="currentMaterials == null || !currentMaterials.length">
        Aucun matériel stocké à cet emplacement
    </div>
    <div v-else class="border rounded-xl overflow-x-auto mt-8">
        <table class="table-auto text-sm lg:text-base w-full">
            <thead>
                <tr class="bg-amber-400 divide-x divide-[#C69202]">
                    <th class="
                    p-2 pl-4 pt-2 pb-2
                    lg:p-4 lg:pl-8 lg:pt-4 lg:pb-4 
                    text-zinc-900 text-left">Matériel</th>
                    <th class="
                    p-2 pl-4 pt-2 pb-2
                    lg:p-4 lg:pl-8 lg:pt-4 lg:pb-4 
                    text-zinc-900 text-left">Stock</th>
                    <th class="
                    p-2 pl-4 pt-2 pb-2
                    lg:p-4 lg:pl-8 lg:pt-4 lg:pb-4 
                    text-zinc-900 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(material, index) in currentMaterials" :class="index % 2 === 0 ? 'bg-white' : 'bg-amber-100/50'" class="divide-x divide-[#E0DDCE]">
                    <td class="
                    p-2 pl-4 
                    lg:p-4 lg:pl-8 
                    text-zinc-900">{{ material.name }}</td>
                    <td class="
                    p-2 pl-4 
                    lg:p-4 lg:pl-8 
                    text-zinc-900">{{ material.current_stock }} / {{ material.max_stock }}</td>
                    <td class="
                    p-2 pl-4 
                    lg:p-4 lg:pl-8 
                    text-zinc-900
                    flex flex-row
                    justify-center">
                        <!-- User edit component pass user and apiaries-->
                        <MaterialEdit :material="material"></MaterialEdit>
                        <MaterialDelete :material_id="material.id"></MaterialDelete>
                        
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>

import MaterialCreate from './MaterialCreate.vue';
import InventoryPlaceCreate from './InventoryPlaceCreate.vue';
import InventoryPlaceEdit from './InventoryPlaceEdit.vue';
import MaterialEdit from './MaterialEdit.vue';
import MaterialDelete from './MaterialDelete.vue';

import { ref } from 'vue';

export default {
    name: "MaterialList",
    props: ['materials', 'inventory_places'],
    components: { 
        MaterialCreate,
        InventoryPlaceCreate,
        InventoryPlaceEdit, 
        MaterialEdit,
        MaterialDelete,
    },
    setup () {

        const childNMounted = ref(false);

        const inventoryPlaceProps = ref({
            inventory_place: null,
            materialsNotDefined: null,
        });
        const currentMaterials = null;

        setTimeout(() => {
            childNMounted.value = true;
        }, 0);

        return {
            childNMounted,
            inventoryPlaceProps,
            currentMaterials,
        };
    },
    methods: {
        changeMaterials() {
            //get the selected inventory place id as number
            //convert it to number because it is a string by default

            let inventory_place_id = document.getElementById('inventory_place_id').value;

            // set current materials equal to materials object of the selected inventory place
            this.currentMaterials = this.materials[inventory_place_id];
           
            //set editprops inventory place as the inventory place with same id as the selected one
            this.inventoryPlaceProps.inventory_place = this.inventory_places.find(inventory_place => inventory_place.id == inventory_place_id);

            //Make array key value of materials types (other, frames, separators, rise, food) called materials_not_defined and then remove each types if they are in matrials props except other
            this.inventoryPlaceProps.materialsNotDefined = {
                frames: 'Cadres',
                separators: 'Séparateurs',
                rise: 'Hausse',
                food: 'Nourriture',
            }

            if(this.currentMaterials != null) {
                //remove each types if they are in matrials props except other
                for (const [key, value] of Object.entries(this.inventoryPlaceProps.materialsNotDefined)) {
                    if (this.currentMaterials.find(material => material.associated_to == key)) {
                        delete this.inventoryPlaceProps.materialsNotDefined[key];
                    }
                }
            }

            console.log(this.inventoryPlaceProps);

        }
    },
    mounted() {
        //console.log(this.materials[1]);
        // set current materials equal to materials object of the selected inventory place (default is the first one)
        this.changeMaterials();

        //console.log(this.materialsNotDefined);
    },
    //components: { UserDelete, UserEdit }
}
</script>

<style scoped>

</style>