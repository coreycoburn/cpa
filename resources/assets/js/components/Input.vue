<template>
    <div>
        <label
            class="block text-grey-darker text-sm font-bold mb-2"
            :for="field"
        >
            {{ title }}
            <span class="text-red" v-show="required">*</span>
        </label>
        <input
            class="appearance-none rounded w-full py-2 px-3 text-grey-darker leading-tight"
            :class="{ 'border border-red': errors[field] }"
            :id="field"
            :name="field"
            type="text"
            :placeholder="this.help ? this.help : this.title"
            @input="updateValue($event.target.value)"
            :value="value"
            @blur="removeError"
        >
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
            description: 'The id / name of the input field'
        },
        title: {
            required: true,
            type: String,
            description: 'The title of the input field'
        },
        value: {
            required: true
        },
        errors: {
            default: Array
        },
        required: {
            default: false
        },
        help: {
            type: String
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
