<template>
    <div>
        <label
            class="block text-grey-darker text-sm font-bold mb-2"
            :for="field"
        >
            {{ title }}
            <span class="text-red text-xs" v-show="required">*</span>
        </label>
        <input
            class="appearance-none rounded w-full py-2 px-3 text-grey-darker leading-tight"
            :class="[formClass, { 'border border-red': errors[field] }]"
            :id="field"
            :name="field"
            :type="inputType"
            :placeholder="this.help ? this.help : this.title"
            @input="updateValue($event.target.value)"
            :value="value"
            @blur="removeError"
            @keydown.enter.prevent=""
            v-mask="maskIt()"
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
import AwesomeMask from 'awesome-mask';

export default {
    directives: {
        'mask': AwesomeMask
    },
    props: {
        inputType: {
            type: String,
            default: 'text'
        },
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
        },
        formClass: {
            type: String
        },
        mask: {
            type: String
        }
    },
    methods: {
        updateValue(value) {
            this.$emit('input', value)
        },
        removeError() {
            this.errors[this.field] = ''
        },
        maskIt() {
            if (this.mask === 'cc') {
                return '9999 9999 9999 9999 999';
            }

            if (this.mask === 'cc-exp') {
                return '99 / 99';
            }

            if (this.mask === 'cc-cvv') {
                return '9999';
            }

            if (this.mask === 'phone') {
                return '(999) 999-9999';
            }

            return '';
        }
    }
}
</script>
