<template>
    <div>
        <input
            type="checkbox"
            :name="field"
            :id="field"
            @input="updateValue"
            :checked=value
            @keydown.enter.prevent=""
        >
        <label
            :for="field"
            class="text-grey-darker text-sm font-bold pt-1"
        >
            {{ title }}
        </label>
    </div>
</template>

<script>
export default {
    props: {
        group: {
            type: String
        },
        field: {
            required: true,
            type: String,
            description: 'The id / name of the checkbox field'
        },
        title: {
            required: true,
            type: String,
            description: 'The title of the checkbox field'
        },
        value: {
            required: true,
            type: Boolean,
            default: false
        },
        errors: {
            default: Array
        }
    },
    methods: {
        updateValue(value) {
            this.$emit('input', !this.value)
            this.errors[this.group] = ''
        }
    }
}
</script>
