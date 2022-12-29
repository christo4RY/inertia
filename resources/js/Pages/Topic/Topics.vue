<template>
  <AuthenticatedLayout>
    <h1 class="text-teal-600 text-5xl ml-32 my-6">Topics</h1>
    <!-- component -->
    <div class="flex flex-col justify-center h-full">
      <!-- Table -->
      <div
        class="
          w-full
          max-w-2xl
          mx-auto
          bg-white
          shadow-lg
          rounded-sm
          border border-gray-200
        "
      >
        <header class="px-5 py-4 border-b border-gray-100">
          <div class="font-semibold text-gray-800">All Topics</div>
        </header>

        <div class="overflow-x-auto p-3">
          <div class="flex justify-end mr-14 mb-4">
            <Link
              :href="route('topic.create')"
              class="
                px-2
                rounded-full
                bg-green-400
                uppercase
                text-gray-100
                hover:bg-emerald-500
                transition-all
              "
            >
              Create
            </Link>
          </div>
          <table class="table-auto w-full">
            <thead
              class="text-xs font-semibold uppercase text-gray-400 bg-gray-50"
            >
              <tr>
                <th class="p-2">
                  <div class="font-semibold text-left">No</div>
                </th>
                <th class="p-2">
                  <div class="font-semibold text-left">Title</div>
                </th>
                <th class="p-2">
                  <div class="font-semibold text-left">Image</div>
                </th>
                <th class="p-2">
                  <div class="font-semibold text-center">Action</div>
                </th>
              </tr>
            </thead>

            <tbody class="text-sm divide-y divide-gray-100">
              <!-- record 1 -->
              <tr v-for="(topic, i) in topics" :key="topic.id">
                <td class="p-2">
                  <div class="font-medium text-gray-800">{{ (i += 1) }}.</div>
                </td>
                <td class="p-2">
                  <div class="font-medium text-gray-800">
                    {{ topic.title }}
                  </div>
                </td>
                <td class="p-2">
                  <img
                    :src="`/storage/${topic.image}`"
                    class="h-[50px]"
                    alt=""
                  />
                </td>
                <td class="p-2">
                  <div class="flex justify-center">
                    <button @click="deleteTopic(topic.id)">
                      <svg
                        class="
                          w-8
                          h-8
                          hover:text-blue-600
                          rounded-full
                          hover:bg-gray-100
                          p-1
                        "
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg"
                      >
                        <path
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                        ></path>
                      </svg>
                    </button>
                    <Link
                      :href="route('topic.edit', topic.id)"
                      method="get"
                      as="button"
                      type="button"
                    >
                      <svg
                        class="
                          w-8
                          h-8
                          hover:text-blue-600
                          rounded-full
                          hover:bg-gray-100
                          bi bi-pen
                          p-1
                        "
                        xmlns="http://www.w3.org/2000/svg"
                        width="16"
                        height="16"
                        fill="currentColor"
                        viewBox="0 0 16 16"
                      >
                        <path
                          d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"
                        />
                      </svg>
                    </Link>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Link } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
const props = defineProps({
  topics: Object,
});
const deleteTopic = (id) => {
  Inertia.delete("/topics/delete/" + id);
};
</script>

<style>
</style>
