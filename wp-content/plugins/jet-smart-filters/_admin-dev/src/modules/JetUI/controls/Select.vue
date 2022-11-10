<template>
	<div class="jet-ui_select"
		 :class="{
			'jet-ui_select--multiple': multiple,
			'jet-ui_select--active': isOpen,
			'jet-ui_select--disabled': disabled
		 }"
		 tabindex="0"
		 ref="select"
		 @focusin="onFocusin"
		 @focusout="onFocusout">
		<!-- Value -->
		<div class="jet-ui_select-value"
			 v-if="selected">
			<!-- Multiple value -->
			<template v-if="multiple">
				<div v-for="( tag, index ) in selected"
					 :key="tag.value"
					 class="jet-ui_select-tag"
					 @mousedown="onTagClick(tag)">
					{{tag.label}}
				</div>
			</template>
			<!-- Single value -->
			<template v-else>
				{{selected.label}}
			</template>
		</div>
		<!-- Placeholder -->
		<div class="jet-ui_select-placeholder"
			 v-else>
			{{placeholder}}
		</div>
		<!-- Clear -->
		<div v-if="selected && clearEnabled"
			 class="jet-ui_select-clear"
			 @mousedown="onClearClick" />
		<!-- Caret -->
		<div class="jet-ui_select-caret"
			 @click="onCaretClick" />
		<!-- Dropdown -->
		<div class="jet-ui_select-dropdown">
			<slot name="beforelist"></slot>
			<!-- Options -->
			<ul v-if="optionsList.length"
				class="jet-ui_select-options">
				<li v-for="( option, index ) in optionsList"
					:key="option.value"
					class="jet-ui_select-option"
					:class="{'jet-ui_select-option--selected': option.selected}"
					@click="onOptionClick(option)">
					{{ option.label }}
				</li>
			</ul>
			<slot v-else
				  name="nooptions">
				<div class="jet-ui_select-nooptions"
					 v-html="noOptionsText" />
			</slot>
			<slot name="afterlist"></slot>
		</div>
	</div>
</template>

<script>
import { defineComponent, ref, computed } from "vue";

export default defineComponent({
	name: "Select",

	emits: [
		'update:modelValue', 'change', 'clear',
		'open', 'close',
	],

	props: {
		modelValue: { type: [String, Number, Array], required: true },
		multiple: { type: Boolean, default: false },
		options: { type: Array, default: () => [] },
		placeholder: { type: String, default: '' },
		noOptionsText: { type: String, default: 'The list is empty' },
		clearEnabled: { type: Boolean, default: false },
		deselect: { type: Boolean, default: false },
		disabled: { type: Boolean, default: false }
	},

	setup(props, context) {
		// Data
		const select = ref('');
		const isOpen = ref(false);

		// Computed data
		const optionsList = computed(() => {
			return props.options.map(({ ...option }) => {
				option.selected = isOptionSelected(option);

				return option;
			}).filter(option => !option.disabled);
		});

		const selected = computed(() => {
			/* if (!props.modelValue)
				return false; */

			if (props.multiple && Array.isArray(props.modelValue)) {
				const selectedData = [];

				props.modelValue.forEach(item => {
					const selectedOption = getOptionByValue(item);

					if (selectedOption)
						selectedData.push(selectedOption);
				});

				return selectedData.length
					? selectedData
					: false;
			} else {
				return getOptionByValue(props.modelValue);
			}
		});

		// Methods
		const updateOption = (option) => {
			let newModelValue = '';

			if (props.multiple) {
				const newValue = option.value;

				newModelValue = props.modelValue && Array.isArray(props.modelValue)
					? [...props.modelValue]
					: [];

				const newValueIndex = newModelValue.indexOf(newValue);

				if (newValueIndex === -1) {
					newModelValue.push(newValue);
				} else {
					newModelValue.splice(newValueIndex, 1);
				}
			} else {
				newModelValue = props.modelValue !== option.value
					? option.value
					: '';
			}

			context.emit('update:modelValue', newModelValue);
		};

		const isOptionSelected = (option) => {
			/* if (!props.modelValue)
				return false; */

			return props.multiple
				? props.modelValue.includes(option.value)
				: props.modelValue === option.value;
		};

		const getOptionByValue = (value) => {
			return optionsList.value.find(option => {
				return option.value === value;
			}) || false;
		};

		const blur = () => {
			select.value.blur();
		};

		// Actions
		const onFocusin = () => {
			if (isOpen.value)
				return;

			isOpen.value = true;
			context.emit('open');
		};

		const onFocusout = () => {
			if (!isOpen.value)
				return;

			isOpen.value = false;
			context.emit('close');
		};

		const onCaretClick = () => {
			blur();
		};

		const onClearClick = () => {
			blur();
			context.emit('update:modelValue', '');
		};

		const onTagClick = (option) => {
			updateOption(option);
		};

		const onOptionClick = (option) => {
			if (!props.deselect && !props.multiple && option.selected)
				return;

			updateOption(option);

			if (!props.multiple)
				blur();
		};

		return {
			select,
			isOpen,
			optionsList,
			selected,
			onFocusin,
			onFocusout,
			onCaretClick,
			onClearClick,
			onTagClick,
			onOptionClick
		};
	}
});
</script>

<style lang="scss">
@import "../scss/controls/select.scss";
</style>