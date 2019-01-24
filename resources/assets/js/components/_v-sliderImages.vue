<template>
	<div>
		<label class="c-btn--choose" :for="index">
			<input type="checkbox"
			:checked="isChecked"
			@click="selectEvent"
			:id="index">
			<div :style="{ 'background-image': 'url(' + origin+image_path+images.name + ')' }" class="c-btn c-btn--choose c-btn--choose--multiple">
				<span class="c-btn__icon" v-show="isChecked"><i class="far fa-check-circle"></i></span>
			</div>
		</label>
		<button type="button" @click="removeEvent(images.id)" class="c-btn c-btn--rounded c-btn--danger">&times;</button>
	</div>
</template>

<script>
    export default {
        props: ['images','index','checkedImages'],
        data() {
            return {
                origin: window.location.origin + '/',
				image_path: 'storage/images/',
				isChecked: false
            }
		},
		methods: {
			selectEvent($event){
				if ($event.target.checked){
					this.$emit('selectImage', this.images.name)
				} else {
					this.$emit('unselectImage', this.images.name)
				}
				this.isChecked = !this.isChecked
			},
			removeEvent($id){
				this.$emit('removeImage', $id)
			}
		},
		mounted(){
			this.checkedImages.forEach(element => {
				if (element === this.images.name) {
					this.isChecked = true
				}
			})
		}
    }
</script>

<style>

</style>