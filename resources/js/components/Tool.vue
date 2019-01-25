<template>
    <div>
        <heading class="mb-6">{{ __('Temply Theme Manager') }}</heading>

        <div class="w-full flex mb-8 shadow-md" v-for="(theme, index) in themes" :class="{ 'border-r-8 border-success': theme.id == activeTheme.id }" :key="index">
            <div class="h-64 w-64 flex-none bg-cover rounded-l text-center overflow-hidden" :style="'background-image: url(' + theme.photo + ')'" title="Woman holding a mug"></div>
            <div class="w-full border-l-0 border-grey-light bg-white rounded-b rounded-r p-4 flex flex-col justify-between leading-normal">
                <div class="mb-8">
                    <div class="text-black font-bold text-xl mb-2">{{ theme.name }}</div>
                    <p class="text-grey-darker text-base">{{ theme.description }}</p>
                </div>
                <div class="w-full flex">
                    <template v-for="(pallete, i) in theme.palletes">
                        <div class="flex-1 rounded  py-1 text font-semibold text-90 mr-2" :key="i">
                            {{ pallete.name }}
                            <div
                                class="flex justify-center rounded shadow-inner bg-50 p-2"
                                :class="{ 'bg-success text-white': pallete.id == activePallete.id }"
                                @mouseover="showButton(pallete)"
                                @mouseout="hideButton(pallete)"
                            >
                                <template v-if="pallete.id == activePallete.id">
                                    <p class="font-bold button-h-8">{{ __('Selected') }}</p>
                                </template>
                                <template v-else>
                                    <button v-if="pallete.active" @click="check(theme, pallete)" class="btn btn-default btn-primary button-h-8">{{ __('Select Pallete') }}</button>
                                    <div v-else class="rounded w-8 h-8 mx-1" :style="'background-color:' + color.color" v-for="(color, ind) in pallete.colors" :key="pallete.id + '_' + ind"></div>
                                </template>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </div>

        <div ref="modals">
            <modal ref="modalConfirm" v-if="modalConfirm" :name="'modalConfirm'" :align="'flex justify-end'">
                <div slot="container">
                    <h2 class="mb-6 text-90 font-normal text-xl">{{ __('Confirmar cambio') }}</h2>
                    <p class="text-80 leading-normal ">{{ __('¿Estas seguro de activar este tema junto con esta paleta?') }}</p>
                    <p class="text-80 leading-normal ">{{ __('Tu tema cambiará por el escogido:') }}</p>
                    <p class="text-80 leading-normal mt-2">
                        <strong>{{ __('Tema') }}:</strong> {{ this.selectedTheme.name }} <br />
                        <strong>{{ __('Paleta') }}:</strong> {{ this.selectedPallete.name }}
                    </p>
                </div>
                <div slot="buttons">
                    <div class="ml-auto">
                        <button type="button" @click.prevent="modalConfirm = !modalConfirm" class="btn text-80 font-normal h-9 px-3 mr-3 btn-link">{{ __('Cancel') }}</button>

                        <button id="confirm-overwrite-button" ref="confirmButton" @click.prevent="confirmTheme" class="btn btn-default btn-danger">{{ __('Sí, seleccionar') }}</button>
                    </div>
                </div>
            </modal>
        </div>
    </div>
</template>

<script>
import api from '../api';
import Modal from './Modal';
export default {
    components: {
        Modal,
    },
    data: () => ({
        themes: {},
        modalConfirm: false,
        activeTheme: null,
        activePallete: null,
        selectedTheme: {},
        selectedPallete: {},
    }),
    mounted() {
        this.getData();
    },

    methods: {
        getData() {
            api.getThemes().then(result => {
                this.themes = result.themes;
                this.activeTheme = result.active.theme;
                this.activePallete = result.active.pallete;
            });
        },

        showButton(pallete) {
            pallete.active = true;
        },
        hideButton(pallete) {
            pallete.active = false;
        },

        check(theme, pallete) {
            this.selectedTheme = theme;
            this.selectedPallete = pallete;
            this.modalConfirm = true;
        },

        confirmTheme() {
            api.setTheme(this.selectedTheme.id, this.selectedPallete.id).then(() => {
                this.getData();
                this.modalConfirm = false;
                this.$toasted.show(this.__('Theme selected successfully!'), { type: 'success' });
            });
        },
    },
};
</script>

<style scoped>
/* Scoped Styles */
.h-64 {
    height: 16rem;
}

.h-9 {
    height: 2.25rem;
}

.button-h-8 {
    height: 2rem !important;
    line-height: 2rem;
}

.w-48 {
    width: 12rem;
}
.w-64 {
    width: 24rem;
}
</style>
