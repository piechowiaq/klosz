<template>
    <Head title="Welcome" />

    <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
        <div v-if="canLogin" class="hidden fixed top-0 right-0 px-6 py-4 sm:block">

            <Link v-if="$page.props.user" :href="route('dashboard')" class="text-sm text-gray-700 underline mr-1">
                Dashboard
            </Link>

            <Link v-if="$page.props.user" :href="route('logout')" method="post" as="button" class="text-sm text-gray-700 underline">
                Logout
            </Link>



            <template v-else>
                <Link :href="route('login')" class="text-sm text-gray-700 underline">
                    Log in
                </Link>


            </template>
        </div>
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="flex pt-8 md:justify-center sm:pt-0">

<!--                    <svg  height="80" viewBox="0 0 908 385" fill="none" xmlns="http://www.w3.org/2000/svg">-->
<!--                        <path d="M242.499 0.590259L329.35 193.108H155.647L242.499 0.590259Z" fill="#D9D9D9"/>-->
<!--                        <path d="M242.499 385L155.647 192.482H329.35L242.499 385Z" fill="#D9D9D9"/>-->
<!--                        <path d="M242.06 0.428835L192.053 203.535L49.764 112.726L242.06 0.428835Z" fill="#D9D9D9"/>-->
<!--                        <path d="M0.15065 315.319L50.158 112.213L192.447 203.022L0.15065 315.319Z" fill="#D9D9D9"/>-->
<!--                        <path d="M242.937 0.428822L435.233 112.726L292.944 203.535L242.937 0.428822Z" fill="#D9D9D9"/>-->
<!--                        <path d="M484.846 315.319L292.55 203.022L434.839 112.213L484.846 315.319Z" fill="#D9D9D9"/>-->
<!--                        <path d="M605.392 240V149.248H614.352V201.984L664.4 149.12H674.256L637.136 189.056L676.176 240H666.064L631.376 194.432L614.352 212.096V240H605.392Z" fill="#FBBF24"/>-->
<!--                        <path d="M686.234 146.56H694.938V224.896C694.938 228.224 695.535 230.4 696.73 231.424C697.925 232.448 699.375 232.96 701.082 232.96C702.618 232.96 704.154 232.789 705.69 232.448C707.226 232.107 708.549 231.765 709.658 231.424L711.194 238.464C709.573 239.147 707.567 239.701 705.178 240.128C702.874 240.555 700.869 240.768 699.162 240.768C695.237 240.768 692.079 239.616 689.69 237.312C687.386 235.008 686.234 231.851 686.234 227.84V146.56Z" fill="#FBBF24"/>-->
<!--                        <path d="M749.141 241.28C744.362 241.28 739.925 240.384 735.829 238.592C731.818 236.715 728.32 234.197 725.333 231.04C722.432 227.797 720.17 224.128 718.549 220.032C716.928 215.851 716.117 211.456 716.117 206.848C716.117 202.069 716.928 197.632 718.549 193.536C720.17 189.355 722.474 185.685 725.461 182.528C728.448 179.285 731.946 176.768 735.957 174.976C740.053 173.099 744.49 172.16 749.269 172.16C754.048 172.16 758.442 173.099 762.453 174.976C766.464 176.768 769.962 179.285 772.949 182.528C775.936 185.685 778.24 189.355 779.861 193.536C781.482 197.632 782.293 202.069 782.293 206.848C782.293 211.456 781.482 215.851 779.861 220.032C778.24 224.128 775.936 227.797 772.949 231.04C770.048 234.197 766.549 236.715 762.453 238.592C758.442 240.384 754.005 241.28 749.141 241.28ZM724.949 206.976C724.949 211.925 726.016 216.448 728.149 220.544C730.368 224.555 733.312 227.755 736.981 230.144C740.65 232.448 744.704 233.6 749.141 233.6C753.578 233.6 757.632 232.405 761.301 230.016C764.97 227.627 767.914 224.384 770.133 220.288C772.352 216.107 773.461 211.584 773.461 206.72C773.461 201.771 772.352 197.248 770.133 193.152C767.914 189.056 764.97 185.813 761.301 183.424C757.632 181.035 753.578 179.84 749.141 179.84C744.704 179.84 740.65 181.077 736.981 183.552C733.397 186.027 730.496 189.312 728.277 193.408C726.058 197.419 724.949 201.941 724.949 206.976Z" fill="#FBBF24"/>-->
<!--                        <path d="M818.738 241.28C813.277 241.28 808.199 240.384 803.506 238.592C798.813 236.8 794.759 234.069 791.346 230.4L794.93 224.256C798.685 227.755 802.439 230.315 806.194 231.936C810.034 233.472 814.087 234.24 818.354 234.24C823.559 234.24 827.783 233.216 831.026 231.168C834.269 229.035 835.89 226.005 835.89 222.08C835.89 219.435 835.079 217.429 833.458 216.064C831.922 214.613 829.661 213.461 826.674 212.608C823.773 211.669 820.274 210.688 816.178 209.664C811.57 208.384 807.687 207.061 804.53 205.696C801.458 204.245 799.111 202.453 797.49 200.32C795.954 198.101 795.186 195.243 795.186 191.744C795.186 187.392 796.253 183.808 798.386 180.992C800.605 178.091 803.591 175.915 807.346 174.464C811.186 172.928 815.453 172.16 820.146 172.16C825.266 172.16 829.789 172.971 833.714 174.592C837.639 176.213 840.839 178.475 843.314 181.376L839.09 187.264C836.701 184.533 833.842 182.528 830.514 181.248C827.271 179.883 823.645 179.2 819.634 179.2C816.903 179.2 814.301 179.584 811.826 180.352C809.351 181.035 807.303 182.229 805.682 183.936C804.146 185.557 803.378 187.819 803.378 190.72C803.378 193.109 803.975 194.987 805.17 196.352C806.365 197.632 808.157 198.741 810.546 199.68C812.935 200.533 815.879 201.472 819.378 202.496C824.413 203.861 828.807 205.269 832.562 206.72C836.317 208.085 839.218 209.877 841.266 212.096C843.314 214.315 844.338 217.429 844.338 221.44C844.338 227.669 841.991 232.533 837.298 236.032C832.605 239.531 826.418 241.28 818.738 241.28Z" fill="#FBBF24"/>-->
<!--                        <path d="M853.093 234.112L897.765 179.84H854.117V173.312H907.621V179.2L863.205 233.472H907.493V240H853.093V234.112Z" fill="#FBBF24"/>-->
<!--                    </svg>-->


              <div class="flex items-center">
    <svg xmlns="http://www.w3.org/2000/svg" width="96" height="96" viewBox="0 0 24 24"><g fill="none" stroke="#478C5C" stroke-width="1.5"><path d="M12 22c-1.02 0-1.38-.158-2.101-.473C7.239 20.365 3 17.63 3 11.991v-1.574c0-3.198 0-4.797.378-5.334C3.755 4.545 5.258 4.03 8.265 3l.573-.196C10.405 2.268 11.188 2 12 2"/><path d="M12 22c1.02 0 1.38-.158 2.101-.473c2.66-1.162 6.9-3.898 6.9-9.536v-1.574c0-3.198 0-4.797-.378-5.334c-.378-.538-1.881-1.053-4.888-2.082l-.573-.196C13.595 2.268 12.812 2 12 2" opacity=".5"/></g></svg>
    <p class="ml-2 text-xl font-bold whitespace-nowrap tracking-widest"><span class="text-red-500">TIMELY</span> RECORD</p>


</div>

            </div>

            <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                <div class="grid grid-cols-1 md:grid-cols-2">
                    <div class="p-6">
                        <div class="flex items-center">
                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-500"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                            <div class="ml-4 text-lg leading-7 font-semibold">Registries</div>
                        </div>

                        <div class="ml-12">
                            <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin tristique, libero vel fringilla cursus, dolor tortor varius nisl, eu volutpat nulla ex nec sapien. Sed dictum, arcu sed bibendum imperdiet, lorem est bibendum tellus, eu varius libero turpis at est. Praesent mollis id dolor at bibendum. Nunc euismod lectus vel urna sollicitudin, sit amet congue augue cursus.
                            </div>
                        </div>
                    </div>

                    <div class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-t-0 md:border-l">
                        <div class="flex items-center">
                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-500"><path d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            <div class="ml-4 text-lg leading-7 font-semibold">Scans</div>
                        </div>

                        <div class="ml-12">
                            <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur convallis facilisis mi, at cursus nulla hendrerit eget. Nulla facilisi. Sed vel justo vel arcu consequat vestibulum.
                            </div>
                        </div>
                    </div>

                    <div class="p-6 border-t border-gray-200 dark:border-gray-700">
                        <div class="flex items-center">
                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-500"><path d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path></svg>
                            <div class="ml-4 text-lg leading-7 font-semibold">Legislation</div>
                        </div>

                        <div class="ml-12">
                            <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin tristique, libero vel fringilla cursus, dolor tortor varius nisl, eu volutpat nulla ex nec sapien. Sed dictum, arcu sed bibendum imperdiet, lorem est bibendum tellus, eu varius libero turpis at est. Praesent mollis id dolor at bibendum. Nunc euismod lectus vel urna sollicitudin, sit amet congue augue cursus.
                            </div>
                        </div>
                    </div>

                    <div class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-l">
                        <div class="flex items-center">
                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-500"><path d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <div class="ml-4 text-lg leading-7 font-semibold text-gray-900 dark:text-white">Vibrant Ecosystem</div>
                        </div>

                        <div class="ml-12">
                            <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent convallis lectus id felis sagittis, a vestibulum lorem efficitur. Nullam sit amet lacus nec velit tincidunt lobortis.
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-center mt-4 sm:items-center sm:justify-between">
                <div class="text-center text-sm text-gray-500 sm:text-left">
                    <div class="flex items-center">
                        <svg fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor" class="-mt-px w-5 h-5 text-gray-400">
                            <path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>

                        <div class="ml-1 underline">
                            Shop
                        </div>

                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="ml-4 -mt-px w-5 h-5 text-gray-400">
                            <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>

                        <div class="ml-1 underline">
                            Follow
                        </div>
                    </div>
                </div>

                <div class="ml-4 text-center text-sm text-gray-500 sm:text-right sm:ml-0">
                    Klosz 2023 | NIP: 111 222 33 44
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
    .bg-gray-100 {
        background-color: #f7fafc;
        background-color: rgba(247, 250, 252, var(--tw-bg-opacity));
    }

    .border-gray-200 {
        border-color: #edf2f7;
        border-color: rgba(237, 242, 247, var(--tw-border-opacity));
    }

    .text-gray-400 {
        color: #cbd5e0;
        color: rgba(203, 213, 224, var(--tw-text-opacity));
    }

    .text-gray-500 {
        color: #a0aec0;
        color: rgba(160, 174, 192, var(--tw-text-opacity));
    }

    .text-gray-600 {
        color: #718096;
        color: rgba(113, 128, 150, var(--tw-text-opacity));
    }

    .text-gray-700 {
        color: #4a5568;
        color: rgba(74, 85, 104, var(--tw-text-opacity));
    }

    .text-gray-900 {
        color: #1a202c;
        color: rgba(26, 32, 44, var(--tw-text-opacity));
    }

    @media (prefers-color-scheme: dark) {
        .dark\:bg-gray-800 {
            background-color: #2d3748;
            background-color: rgba(45, 55, 72, var(--tw-bg-opacity));
        }

        .dark\:bg-gray-900 {
            background-color: #1a202c;
            background-color: rgba(26, 32, 44, var(--tw-bg-opacity));
        }

        .dark\:border-gray-700 {
            border-color: #4a5568;
            border-color: rgba(74, 85, 104, var(--tw-border-opacity));
        }

        .dark\:text-white {
            color: #fff;
            color: rgba(255, 255, 255, var(--tw-text-opacity));
        }

        .dark\:text-gray-400 {
            color: #cbd5e0;
            color: rgba(203, 213, 224, var(--tw-text-opacity));
        }
    }
</style>

<script>
    import { defineComponent } from 'vue'
    import { Head, Link } from '@inertiajs/inertia-vue3';

    export default defineComponent({
        components: {
            Head,
            Link,
        },

        props: {
            canLogin: Boolean,
            canRegister: Boolean,
        }
    })
</script>
