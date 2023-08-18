<template>

    <Head title="Welcome" />

    <div class="relative flex items-top justify-center min-h-screen min-w-fit bg-gray-100 dark:bg-gray-900">

        <div v-if="canLogin && $page.props.user" class=" absolute top-0 right-0 px-6 py-4 block">
            <Link  :href="route('dashboard')" class=" text-sm text-gray-700 underline mr-1">
                Dashboard
            </Link>
            <Link  :href="route('logout')" method="post" as="button" class=" text-sm text-gray-700 underline">
                Logout
            </Link>
        </div>
        <div v-if="canLogin && !$page.props.user" class=" absolute xl:fixed top-0 right-0 px-6 py-4 block">
            <Link  :href="route('login')" class="text-sm text-gray-700 underline">
                Log in
            </Link>
        </div>

        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

            <div class="pt-6 px-20">
                <div class="pt-8 sm:pt-0 flex items-center justify-center md:justify-start" >
                    <svg xmlns="http://www.w3.org/2000/svg" width="88" height="88" viewBox="0 0 24 24" class="stroke-cyan-600 fill-gray-600 stroke-1"><path d="M12 22c-1.02 0-1.38-.158-2.101-.473C7.239 20.365 3 17.63 3 11.991v-1.574c0-3.198 0-4.797.378-5.334C3.755 4.545 5.258 4.03 8.265 3l.573-.196C10.405 2.268 11.188 2 12 2"/><path d="M12 22c1.02 0 1.38-.158 2.101-.473c2.66-1.162 6.9-3.898 6.9-9.536v-1.574c0-3.198 0-4.797-.378-5.334c-.378-.538-1.881-1.053-4.888-2.082l-.573-.196C13.595 2.268 12.812 2 12 2" opacity=".5"/></svg>
                    <p class="ml-2 text-2xl font-bold whitespace-nowrap tracking-widest text-gray-600"><span class="text-cyan-600 " >TIMELY</span> RECORD</p>
                </div>
                <div class="mt-8 text-xl dark:text-white">
                    Welcome to your Timely Record application!
                </div>
                <div class="mt-6 text-gray-500 text-justify">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin tristique, libero vel fringilla cursus, dolor tortor varius nisl, eu volutpat nulla ex nec sapien. Sed dictum, arcu sed bibendum imperdiet, lorem est bibendum tellus, eu varius libero turpis at est.
                </div>
            </div>



                   <div class="mt-8   overflow-hidden ">
<div class="bg-white dark:bg-gray-800 shadow rounded-lg">
                       <div v-if="!contact" class="grid grid-cols-1 md:grid-cols-2 ">
                           <div class="p-6">
                               <div class="flex items-center">
                                   <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-500"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                                   <div class="ml-4 text-lg leading-7 font-semibold dark:text-white">Registries</div>
                               </div>
                               <div class="mx-12">
                                   <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm text-justify">
                                       Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin tristique, libero vel fringilla cursus, dolor tortor varius nisl, eu volutpat nulla ex nec sapien. Sed dictum, arcu sed bibendum imperdiet, lorem est bibendum tellus, eu varius libero turpis at est. Praesent mollis id dolor at bibendum. Nunc euismod lectus vel urna sollicitudin, sit amet congue augue cursus.
                                   </div>
                               </div>
                           </div>
                           <div class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-t-0 md:border-l">
                               <div class="flex items-center">
                                   <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-500"><path d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                   <div class="ml-4 text-lg leading-7 font-semibold dark:text-white">Scans</div>
                               </div>
                               <div class="mx-12">
                                   <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm text-justify">
                                       Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur convallis facilisis mi, at cursus nulla hendrerit eget. Nulla facilisi. Sed vel justo vel arcu consequat vestibulum.
                                   </div>
                               </div>
                           </div>
                           <div class="p-6 border-t border-gray-200 dark:border-gray-700">
                               <div class="flex items-center">
                                   <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-500"><path d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path></svg>
                                   <div class="ml-4 text-lg leading-7 font-semibold dark:text-white">Legislation</div>
                               </div>
                               <div class="mx-12">
                                   <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm text-justify">
                                       Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin tristique, libero vel fringilla cursus, dolor tortor varius nisl, eu volutpat nulla ex nec sapien. Sed dictum, arcu sed bibendum imperdiet, lorem est bibendum tellus, eu varius libero turpis at est. Praesent mollis id dolor at bibendum. Nunc euismod lectus vel urna sollicitudin, sit amet congue augue cursus.
                                   </div>
                               </div>
                           </div>
                           <div class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-l">
                               <div class="flex items-center">
                                   <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-500"><path d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                   <div class="ml-4 text-lg leading-7 font-semibold text-gray-900 dark:text-white">Vibrant Ecosystem</div>
                               </div>
                               <div class="mx-12">
                                   <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm text-justify">
                                       Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent convallis lectus id felis sagittis, a vestibulum lorem efficitur. Nullam sit amet lacus nec velit tincidunt lobortis.
                                   </div>
                               </div>
                           </div>
                       </div>
</div>
                       <div class="">
                       <div v-if="!contact" class=" lg:flex lg:justify-center grid grid-cols-1">
                           <div class="p-6 lg:w-1/2 bg-white dark:bg-gray-800 shadow rounded-lg">
                               <div class="flex justify-between">
                               <div class="flex items-center">
                                   <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-gray-500" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m4 6l6.108 4.612l.002.002c.678.497 1.017.746 1.389.842a2 2 0 0 0 1.002 0c.372-.096.712-.345 1.392-.844c0 0 3.917-3.006 6.107-4.612M3 15.8V8.2c0-1.12 0-1.68.218-2.108c.192-.377.497-.682.874-.874C4.52 5 5.08 5 6.2 5h11.6c1.12 0 1.68 0 2.107.218c.377.192.683.497.875.874c.218.427.218.987.218 2.105v7.607c0 1.118 0 1.676-.218 2.104a2.002 2.002 0 0 1-.875.874c-.427.218-.986.218-2.104.218H6.197c-1.118 0-1.678 0-2.105-.218a2 2 0 0 1-.874-.874C3 17.48 3 16.92 3 15.8Z"/></svg>
                                   <div class="ml-4 text-lg leading-7 font-semibold dark:text-white">Contact</div>
                               </div>
                               <div>
                                   <svg xmlns="http://www.w3.org/2000/svg" class="m-4 w-4 h-4 text-gray-500" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 6L6 18M6 6l12 12"/></svg>
                               </div>
                               </div>
                               <div class="mx-12">
                                       <form  class="mt-2 text-gray-600 dark:text-gray-400 text-sm text-justify" >
                                               <text-input   label="Name" type="text" />
                                               <text-input   class="mt-2" label="Email" type="email"  autocapitalize="off" />
                                               <text-area  class="mt-2" label="Message" type="text" />
                                               <p class="p-2 text-xs text-center">We will do our best to get back to you within 24h!</p>
                                           <div class="flex px-10 py-4 bg-gray-100 border-t border-gray-100">
                                               <Link as="button"  class="btn-cyan ml-auto" >Send</Link>
                                           </div>
                                       </form>
                               </div>
                           </div>
                       </div>
                       <div v-if="!contact" class=" md:flex md:justify-center grid grid-cols-1">
                           <div class="p-6 lg:w-1/2 bg-white dark:bg-gray-800 shadow rounded-lg">
                               <div class="flex justify-between">
                               <div class="flex items-center">
                                   <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-gray-500" viewBox="0 0 1024 1024"><path fill="currentColor" d="M521.7 82c-152.5-.4-286.7 78.5-363.4 197.7c-3.4 5.3.4 12.3 6.7 12.3h70.3c4.8 0 9.3-2.1 12.3-5.8c7-8.5 14.5-16.7 22.4-24.5c32.6-32.5 70.5-58.1 112.7-75.9c43.6-18.4 90-27.8 137.9-27.8c47.9 0 94.3 9.3 137.9 27.8c42.2 17.8 80.1 43.4 112.7 75.9c32.6 32.5 58.1 70.4 76 112.5C865.7 417.8 875 464.1 875 512c0 47.9-9.4 94.2-27.8 137.8c-17.8 42.1-43.4 80-76 112.5s-70.5 58.1-112.7 75.9A352.8 352.8 0 0 1 520.6 866c-47.9 0-94.3-9.4-137.9-27.8A353.84 353.84 0 0 1 270 762.3c-7.9-7.9-15.3-16.1-22.4-24.5c-3-3.7-7.6-5.8-12.3-5.8H165c-6.3 0-10.2 7-6.7 12.3C234.9 863.2 368.5 942 520.6 942c236.2 0 428-190.1 430.4-425.6C953.4 277.1 761.3 82.6 521.7 82zM395.02 624v-76h-314c-4.4 0-8-3.6-8-8v-56c0-4.4 3.6-8 8-8h314v-76c0-6.7 7.8-10.5 13-6.3l141.9 112a8 8 0 0 1 0 12.6l-141.9 112c-5.2 4.1-13 .4-13-6.3z"/></svg>
                                   <div class="ml-4 text-lg leading-7 font-semibold dark:text-white">Login</div>
                               </div>
                               <div>
                                   <svg xmlns="http://www.w3.org/2000/svg" class="m-4 w-4 h-4 text-gray-500" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 6L6 18M6 6l12 12"/></svg>
                               </div>
                               </div>
                               <div class="mx-12">
                                   <form class="mt-2 text-gray-600 dark:text-gray-400 text-sm text-justify" @submit.prevent="login">


                                           <text-input   label="Email" type="email"  />
                                           <text-input class="mt-2" label="Password" type="password" />
                                           <label class="p-2 text-xs flex items-center  select-none" for="remember">
                                               <input id="remember"  class="mr-1" type="checkbox" />
                                               <span class="text-xs">Remember Me</span>
                                           </label>

                                       <div class="flex px-10 py-4 bg-gray-100 border-t border-gray-100">
                                           <Link as="button"  class="btn-cyan ml-auto" >Login</Link>
                                       </div>
                                   </form>
                               </div>
                           </div>
                       </div>
                   </div>
                   </div>

            <div class="flex justify-center my-4 sm:items-center sm:justify-between">
                <div class="text-center text-sm text-gray-500 sm:text-left">
                    <div class="flex items-center">
                        <div>
                            <a href="https://linkedin.com/company/timely-record/" target="_blank">
                            <svg class="fill-gray-500 hover:fill-cyan-600" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M20.47 2H3.53a1.45 1.45 0 0 0-1.47 1.43v17.14A1.45 1.45 0 0 0 3.53 22h16.94a1.45 1.45 0 0 0 1.47-1.43V3.43A1.45 1.45 0 0 0 20.47 2ZM8.09 18.74h-3v-9h3ZM6.59 8.48a1.56 1.56 0 1 1 0-3.12a1.57 1.57 0 1 1 0 3.12Zm12.32 10.26h-3v-4.83c0-1.21-.43-2-1.52-2A1.65 1.65 0 0 0 12.85 13a2 2 0 0 0-.1.73v5h-3v-9h3V11a3 3 0 0 1 2.71-1.5c2 0 3.45 1.29 3.45 4.06Z"/></svg>
                            </a>
                        </div>
                        <div class="ml-2">
                            <a href="https://facebook.com/people/Timely-Record/61550085031784/" target="_blank">
                            <svg class="fill-gray-500 hover:fill-cyan-600" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" ><path id="feFacebook2" d="M15.725 22v-7.745h2.6l.389-3.018h-2.99V9.31c0-.874.243-1.47 1.497-1.47h1.598v-2.7a21.391 21.391 0 0 0-2.33-.12c-2.304 0-3.881 1.407-3.881 3.99v2.227H10v3.018h2.607V22H3.104C2.494 22 2 21.506 2 20.896V3.104C2 2.494 2.494 2 3.104 2h17.792C21.506 2 22 2.494 22 3.104v17.792c0 .61-.494 1.104-1.104 1.104h-5.171Z"/></svg>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="ml-4 text-center text-xs text-gray-500 items-center sm:text-right sm:ml-0 flex">
                    <button @click="contact = !contact" class=" text-xs text-gray-400 hover:text-cyan-600 underline">
                     contact@timelyrecod.com
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>


</style>


<script setup>

import { Head, Link } from '@inertiajs/inertia-vue3';
import TextInput from '@/Shared/TextInput'
import TextArea from '@/Shared/TextArea'
import LoadingButton from '@/Shared/LoadingButton'
import { ref } from 'vue';

const props = defineProps({
        canLogin: Boolean
    })

const contact = ref(false);

</script>
