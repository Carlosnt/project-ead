<template>

            <li v-for="person in people" :key="person.email" class="flex justify-between gap-x-6 py-5">
              <div class="flex min-w-0 gap-x-4">                
                <div class="min-w-0 flex-auto">
                  <p class="text-sm font-semibold leading-6 text-gray-900">
                    {{ person.name }} 
                    <span class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">
                  Ativo
                  </span></p> 
                  <p class="mt-1 truncate text-xs leading-5 text-gray-500">10 Artigos publicados</p>
                 
                </div>
              </div>
              
              <div class="flex flex-none items-center gap-x-4">
                <Link 
                  :class="'hidden rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-gray-300 hover:bg-gray-50 sm:block'">
                  <span class="flex intens-center gap-x-3">
                      <PencilSquareIcon class="w-4 h-4 shrink-0" />
                      Editar
                  </span>
                </Link>  

                <Link 
                  :class="'hidden rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-gray-300 hover:bg-gray-50 sm:block'">
                  <span class="flex intens-center gap-x-3">
                      <LinkIcon class="w-4 h-4 shrink-0" />
                      Ver no Site
                  </span>
                </Link> 

                <div class="relative flex-none sm:hidden">
                    <button class="-m-2.5 block p-2.5 text-gray-500 hover:text-gray-900" type="button"
                    v-on:click="toggleDropdown">
                        <span class="sr-only">Abrir Opções</span>
                        <EllipsisVerticalIcon class="w-5 h-5" />
                    </button>
                    <Transition 
                        enter-active-class="transition ease-out duration-100"
                        enter-from-class="transformn opacity-0 scale-95"
                        enter-to-class="transform opacity-100 scale-100"
                        leave-active-class="transition ease-in duration-75"
                        leave-from-class="transition opacity-100 scale-100"
                        leave-to-class="transform opacity-0 scale-95"
                    >
                    <div v-if="dropdown"
                     class="absolute right-6 z-10 mt-2 w-32 origin-top-right rounded-md bg-white py-2 shadow-lg ring-1 ring-gray-900/5 focus:outline-none">
                        <a class="block px-3 py-1 text-sm leading-6 text-gray-900 hover:bg-gray-100"
                        href="'#'">Editar</a>
                        <a class="block px-3 py-1 text-sm leading-6 text-gray-900 hover:bg-gray-100"
                        href="'#'">Ver no Site</a>
                    </div>

                  </Transition>
                </div>
              </div>
            </li>

</template>

<script setup>
    import { ref } from 'vue';
    import { PencilSquareIcon, LinkIcon, EllipsisVerticalIcon } from '@heroicons/vue/24/outline';
    const dropdown = ref(false);
    const toggleDropdown = () => {
        dropdown.value =!dropdown.value; 
    }
</script>