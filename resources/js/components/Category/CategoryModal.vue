<!-- CategoryModal.vue -->
<template>
    <div class="modal" tabindex="-1" role="dialog" :class="{ show: isShown }">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">{{ isCreate ? 'Crear' : 'Editar' }} Categoría</h5>
            <button type="button" class="close" @click="closeModal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form @submit.prevent="saveCategory">
              <div class="form-group">
                <label for="categoryName">Nombre de la categoría</label>
                <input type="text" class="form-control" id="categoryName" v-model="categoryData.name" required>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" @click="closeModal">Cancelar</button>
            <button type="button" class="btn btn-primary" @click="saveCategory">Guardar</button>
          </div>
        </div>
      </div>
    </div>
  </template>

  <script>
  import { ref, watch, computed } from "vue";

  export default {
    props: {
      category: {
        type: Object,
        default: null,
      },
      isShown: {
        type: Boolean,
        default: false,
      },
    },
    setup(props, { emit }) {
      const categoryData = ref({ name: "" });

      watch(
        () => props.category,
        (newValue) => {
          if (newValue) {
            categoryData.value = { ...newValue };
          } else {
            categoryData.value = { name: "" };
          }
        },
        { immediate: true }
      );

      const isCreate = computed(() => props.category === null);

      const closeModal = () => {
        emit("close-modal");
      };

      const saveCategory = () => {
        // Aquí puedes agregar la lógica para guardar la categoría
        console.log("Guardar categoría:", categoryData.value);
        emit("save-category", categoryData.value);
        closeModal();
      };

      return {
        categoryData,
        isCreate,
        closeModal,
        saveCategory,
      };
    },
  };
  </script>
