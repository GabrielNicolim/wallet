<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import InputError from '@/Components/InputError.vue'
import InputLabel from '@/Components/InputLabel.vue'
import TextInput from '@/Components/TextInput.vue'
import { Head, useForm } from '@inertiajs/vue3'

const form = useForm({
  name: '',
})

</script>

<template>
  <Head title="Carteira" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Adicionar - Carteira</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
          <h2 class="text-lg font-medium text-gray-900">Informações da carteira</h2>

          <form class="mt-6 space-y-6 md:w-1/2" @submit.prevent="form.post(route('wallet.store'))">
            <div>
              <InputLabel for="name" value="Nome" />

              <TextInput
                id="name"
                v-model="form.name"
                type="text"
                class="mt-1 block w-full"
                required
                autofocus
              />

              <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div class="flex items-center gap-4">
              <PrimaryButton :disabled="form.processing">Adicionar</PrimaryButton>

              <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition ease-in-out">
                <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Salvo</p>
              </Transition>
            </div>
          </form>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
