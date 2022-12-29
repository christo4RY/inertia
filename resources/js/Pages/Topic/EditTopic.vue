<template>
  <AuthenticatedLayout>
    <h1 class="text-teal-600 text-5xl ml-32 my-6">
      Edit <span class="uppercase font-semibold">{{ topic.title }}</span> Topic
    </h1>
    <div class="">
      <div class="w-3/6 mx-auto">
        <form @submit.prevent="updateTopic(topic.id)">
          <div class="shadow sm:overflow-hidden sm:rounded-md">
            <div class="space-y-6 bg-white px-4 py-5 sm:p-6">
              <div>
                <label
                  for="about"
                  class="block text-sm font-medium text-gray-700"
                  >Title</label
                >
                <div class="mt-1">
                  <input
                    id="about"
                    name="about"
                    class="px-3 py-2 w-full border-red-400"
                    placeholder="title"
                    v-model="form.title"
                  />
                </div>
                <p class="text-red-600 my-2" v-if="errors.title">
                  {{ errors.title }}
                </p>
              </div>
              <div>
                <img
                  :src="`/storage/${topic.image}`"
                  class="h-[100px] rounded-2xl"
                  alt=""
                />
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700"
                  >Image</label
                >
                <div
                  class="
                    mt-1
                    flex
                    justify-center
                    rounded-md
                    border-2 border-dashed border-gray-300
                    px-6
                    pt-5
                    pb-6
                  "
                >
                  <div class="space-y-1 text-center">
                    <svg
                      class="mx-auto h-12 w-12 text-gray-400"
                      stroke="currentColor"
                      fill="none"
                      viewBox="0 0 48 48"
                      aria-hidden="true"
                    >
                      <path
                        d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
                    </svg>
                    <div class="flex text-sm text-gray-600">
                      <label
                        for="file-upload"
                        class="
                          relative
                          cursor-pointer
                          rounded-md
                          bg-white
                          font-medium
                          text-indigo-600
                          focus-within:outline-none
                          focus-within:ring-2
                          focus-within:ring-indigo-500
                          focus-within:ring-offset-2
                          hover:text-indigo-500
                        "
                      >
                        <span>Upload a file</span>
                        <input
                          id="file-upload"
                          name="file-upload"
                          type="file"
                          class="sr-only"
                          @input="form.image = $event.target.files[0]"
                        />
                      </label>
                      <p class="pl-1">or drag and drop</p>
                    </div>
                    <p class="text-xs text-gray-500">
                      PNG, JPG, GIF up to 10MB
                    </p>
                  </div>
                </div>
              </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
              <button
                type="submit"
                class="
                  inline-flex
                  justify-center
                  rounded-md
                  border border-transparent
                  bg-indigo-600
                  py-2
                  px-4
                  text-sm
                  font-medium
                  text-white
                  shadow-sm
                  hover:bg-indigo-700
                  focus:outline-none
                  focus:ring-2
                  focus:ring-indigo-500
                  focus:ring-offset-2
                "
              >
                Save
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>

    <div class="hidden sm:block" aria-hidden="true">
      <div class="py-5">
        <div class="border-t border-gray-200"></div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

  <script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Inertia } from "@inertiajs/inertia";
import { reactive } from "@vue/reactivity";
const props = defineProps({
  topic: Object,
  errors: Object,
});
const form = reactive({
  title: props.topic.title,
  image: null,
});

let updateTopic = (id) => {
  Inertia.post("/topics/edit/" + id, {
    _method: "put",
    title: form.title,
    image: form.image,
  });
};
</script>

  <style>
</style>
