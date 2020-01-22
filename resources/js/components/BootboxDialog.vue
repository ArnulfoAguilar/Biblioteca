<template>
  <div class="hidden"></div>
</template>

<script>
  export default {

    props: {
      config: { type: Object },
      title: String,
      size: String
    },

    beforeMount: function() {
      var vm = this;

      var el = document.createElement('div');
      vm._dialog = bootbox.dialog(Object.assign({}, {
        title: this.title,
        message: el,
        closeButton: true,
        backdrop: true,
        size: this.size,
        callback() {
        },
        onEscape() {
          if (vm._readyToDestroy) {
            vm.$emit('close');
          }
          return false;
        },
      }, vm.config));


      vm._dialog.on('shown.bs.modal', () => {
        vm._readyToDestroy = true;
      });

      vm._dialog.init(function() {
        vm._tempVm = new Vue({
          el: el,
          parent: vm,
          render: function(h) {
            return h('div', [
              h('div', [
                vm.$slots.default,
              ]),
              h('div', [
                vm.$slots.buttons,
              ]),
            ]);
          },
        });
        vm._updateHandler = function() {
          vm._tempVm.$nextTick(vm._tempVm.$forceUpdate);
        };

        vm.$on('hook:updated', vm._updateHandler);
      });

    },

    beforeDestroy() {
      this._dialog.modal('hide');
      this.$off('hook:updated', this._updateHandler);
      this._tempVm.$destroy();
      this._dialog = undefined;
    },
  };
</script>
