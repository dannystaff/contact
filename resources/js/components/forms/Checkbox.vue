<template>
    <div class="form-group mb-4">
        <label class="checkbox">
            <sup v-if="required">*</sup>
            <slot></slot>

            <input  
                type="checkbox"  
                :checked="modelValue"
                :required="required"
                :disabled="disabled"
                :value="true"
                @change="$emit('update:modelValue', $event.target.checked)"/>

            <span class="checkmark"></span>
        </label>
    </div>
</template>

<script>
    export default {
        name: "Checkbox",
        props: {
            modelValue: {
                default: false
            },

            required: {
                type: Boolean,
                default: false
            },

            disabled: {
                default: false
            },
        },
        data(){
            return {
                checked: false
            }
        },
        emits: ['update:modelValue']
    }
</script>