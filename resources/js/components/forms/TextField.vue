<template>
    <div class="form-group mb-4">
        <label class="mb-1" v-if="label" :for="id">
            {{ label }}
            <sup class="text-danger" v-if="required">*</sup>
        </label>

        <div class="position-relative m-0">
            <textarea :id="id" v-if="type == 'textarea'" rows="3"
                :required="required"
                :disabled="disabled"
                :autocomplete="autocomplete"
                :placeholder="placeholder"
                class="form-control mb-0"
                :class="{classes, 'is-invalid': errors, 'is-valid': isValid}"
                :value="modelValue"
                @input="$emit('update:modelValue', $event.target.value)"
                @focus="$emit('focus', $event.target.value)"
                @blur="$emit('blur', $event.target.value)"
            ></textarea>

            <input :id="id" v-else
                :type="type"
                :autocomplete="autocomplete"
                :required="required"
                :disabled="disabled"
                :placeholder="placeholder"
                class="form-control mb-0"
                :class="{classes, 'is-invalid': errors, 'is-valid': isValid}"
                :value="modelValue"
                @input="$emit('update:modelValue', $event.target.value)"
                @focus="$emit('focus', $event.target.value)"
                @blur="$emit('blur', $event.target.value)"
            />
        </div>

        <div v-for="(error, index) in errors" :key="index" class="d-block invalid-feedback mb-1">
            {{ error }}
        </div>
    </div>
</template>

<script>
    export default {
        name: "TextField",
        props: {
            modelValue: {
                required: false
            },

            fieldId: {
                required: false
            },

            classes: {
                type: String,
                required: false
            },

            label: {
                type: String,
                required: false
            },

            placeholder: {
                type: String,
                required: false
            },

            type: {
                type: String,
                default: 'text'
            },

            required: {
                type: Boolean,
                default: false
            },

            disabled: {
                type: Boolean,
                default: false
            },

            autocomplete: {
                default: "on"
            },

            valid: {
                type: Boolean,
                default: false
            },

            errors: {
                type: Object,
                required: false
            }
        },
        emits: ['update:modelValue', 'focus', 'blur'],
        computed: {
            id(){
                if(this.fieldId){
                    return this.fieldId;
                }

                if(!this.label){
                    return ''
                }

                return this.label
                    .toLowerCase()
                    .trim()
                    .replace(/[^\w\s-]/g, '')
                    .replace(/[\s_-]+/g, '-')
                    .replace(/^-+|-+$/g, '');
            },

            isValid(){
                return this.valid && !this.errors;
            }
        }
    }
</script>