<template>
    <div>
        <label
            class="block text-grey-darker text-sm font-bold mb-2"
            :for="field"
        >
            {{ title }}
            <span class="text-red text-xs" v-show="required">*</span>
        </label>
        <select
            :id="field"
            :name="field"
            v-model="selected"
            class="appearance-none bg-white rounded w-full py-2 px-3 text-grey-darker leading-tight"
            :class="[formClass, { 'border border-red': errors[field] }]"
            @change="updateValue($event.target.value)"
            @blur="removeError"
            @keydown.enter.prevent=""
        >
            <!-- <option value="" disabled selected></option> -->

            <option disabled value="" selected hidden></option>
            <option v-for="({ data, title }, index) in options" :value="data" :key="index">{{ title }}</option>
        </select>
        <transition name="fade">
            <span
                class="text-sm text-red-dark mt-2 block"
                role="alert"
                v-if="errors[field]"
            >
                {{ errors[field][0] }}
            </span>
        </transition>
    </div>
</template>

<script>
export default {
    props: {
        field: {
            required: true,
            type: String,
            description: 'The id / name of the select field'
        },
        title: {
            required: true,
            type: String,
            description: 'The title of the select field'
        },
        value: {
            required: true
        },
        options: {
            required: true,
            description: 'The options for the select field'
        },
        errors: {
            default: Array
        },
        required: {
            default: false
        },
        formClass: {
            type: String
        }
    },
    computed: {
        selected: {
            get: function() {
                return this.value
            },
            set: function() {
                return this.value
            }
        }
    },
    methods: {
        updateValue(value) {
            this.$emit('input', value)
        },
        removeError() {
            this.errors[this.field] = ''
        }
    }
}
</script>
