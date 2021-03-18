<template>
  <div>
    <t-modal
      name="modal-name"
      @before-open="onBeforeOpen"
    >
      hello {{ user ? user.name : '' }}
    </t-modal>
    <button type="button" @click="$modal.show('modal-name', { user: { name: 'Alfonso'} })">
      Show modal
    </button>
  </div>
</template>

<script>
export default {
  data () {
    return {
      user: undefined
    }
  },
  methods: {
    onBeforeOpen ({ params, cancel }) {
      // you can add a condition to cancel the modal opening
      if (false) {
        cancel()
      }

      this.user = params.user
    }
  }
}
</script>