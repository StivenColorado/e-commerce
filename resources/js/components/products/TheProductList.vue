<template>
  <section>
    <div class="card bg-table">
      <div class="card-header d-flex justify-content-end">
        <button class="btn btn-primary btn-custom" @click="openModal">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            width="20"
            height="20"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round"
            class="icon icon-tabler icons-tabler-outline icon-tabler-productmark"
          >
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M18 7v14l-6 -4l-6 4v-14a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4z" />
          </svg>

          <span> Crear producto </span>
        </button>
      </div>
      <div class="card-body bg-table">
        <div class="table-responsive my-4 mx-2">
          <table class="col-12 bg-table" id="product_table">
            <thead style="height: 3em">
              <tr>
                <th>Titulo</th>
                <th>Autor</th>
                <th>Categoria</th>
                <th>Cantidad</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              <tr
                v-for="(product, index) in products"
                :key="index"
                class="bg-custom-row"
                style="height: 3em"
              >
                <td>{{ product.title }}</td>
                <td>{{ product.author.name }}</td>
                <td>{{ product.category.name }}</td>
                <td>{{ product.stock }}</td>
                <td>
                  <div class="d-flex justify-content-center" title="Editar">
                    <button
                      type="button"
                      class="btn text-yellow btn-sm"
                      @click="editproduct(product)"
                      :title="'Editar producto con ID: ' + product.id"
                    >
                      <i class="fas fa-pencil-alt"></i>
                    </button>

                    <button
                      type="button"
                      class="btn text-red btn-sm ms-2"
                      title="Eliminar"
                      @click="deletproduct(product)"
                    >
                      <i class="fas fa-trash-alt"></i>
                    </button>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div>
        <product-modal
          :authors_data="authors_data"
          :product_data="product"
          ref="product_modal"
        />
      </div>
    </div>
  </section>
</template>

<script>
import productModal from "./ProductModal.vue";
import { deleteMessage, successMessage } from "../../helpers/Alerts";

export default {
  components: {
    productModal,
  },
  props: ["products", "authors_data"],
  data() {
    return {
      modal: null,
      product: {},
    };
  },
  mounted() {
    this.index();
  },
  methods: {
    async index() {
      $("#product_table").DataTable();
      const modal_id = document.getElementById("product_modal");
      this.modal = new bootstrap.Modal(modal_id);
      modal_id.addEventListener("hidden.bs.modal", (e) => {
        this.$refs.product_modal.reset();
      });
    },
    editproduct(product) {
      this.product = product;
      this.openModal();
    },
    async deletproduct({ id }) {
      if (!(await deleteMessage())) return;
      try {
        await axios.delete(`/products/${id}`);
        await successMessage({ is_delete: true, reload: true });
      } catch (error) {
        console.error(error);
      }
    },
    openModal() {
      this.modal.show();
    },
  },
};
</script>

