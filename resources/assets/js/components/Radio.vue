<template>
    <label class="flex items-center text-grey-darker text-sm font-bold pt-1 mr-6">
        <input
            type="radio"
            :name=field
            :checked=check
            @input=updateValue
            @keydown.enter.prevent=""
        >
        {{ title }}
    </label>
</template>

<script>
export default {
    props: {
        field: {
            required: true,
            type: String,
            description: 'The id / name of the radio field'
        },
        title: {
            required: true,
            type: String,
            description: 'The title of the radio field'
        },
        val: {
            required: true,
            type: String
        },
        check: {
            default: false,
            type: Boolean
        }
    },
    methods: {
        updateValue(value) {
            this.$emit('input', this.val)
        }
    }
}
</script>
