<template>
	<div>
		home
	</div>
</template>
<script type="text/javascript">
	import Flash from '../helper/flash'
	export default{
		data(){
			return{
				flash:Flash.state
			}
		},
		created(){
			console.log(this.flash.username)
		}
	}
</script>