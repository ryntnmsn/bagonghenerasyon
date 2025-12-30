<template>
    <!-- Header -->
    <section class="bg-white">
        <div class="max-w-[1400px] mx-auto px-6 py-16 text-center">
            <h1 class="text-4xl font-medium mb-4">About Us</h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Learn more about who we are, what we do, and why we do it.
            </p>
        </div>
    </section>

    <!-- About Content -->
    <section
        class="max-w-[1400px] mx-auto px-6 py-16 grid md:grid-cols-2 gap-12 items-center"
    >
        <div>
            <h2 class="text-3xl font-medium mb-4">Our Story</h2>
            <p class="text-gray-600 mb-4">
                "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut
                enim ad minim veniam, quis nostrud exercitation ullamco laboris
                nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor
                in reprehenderit in voluptate velit esse cillum dolore eu fugiat
                nulla pariatur.
            </p>
            <p class="text-gray-600">
                Sed ut perspiciatis unde omnis iste natus error sit voluptatem
                accusantium doloremque laudantium, totam rem aperiam, eaque ipsa
                quae ab illo inventore veritatis et quasi architecto beatae
                vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia
                voluptas sit aspernatur aut odit aut fugit, sed quia
                consequuntur magni dolores eos qui ratione voluptatem sequi
                nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor
                sit amet, consectetur, adipisci velit, sed quia non numquam eius
                modi tempora incidunt ut labore et dolore magnam aliquam quaerat
                voluptatem. Ut enim ad minima veniam, quis nostrum
                exercitationem ullam corporis suscipit laboriosam, nisi ut
                aliquid ex ea commodi consequatur? Quis autem vel eum iure
                reprehenderit qui in ea voluptate velit esse quam nihil
                molestiae consequatur, vel illum qui dolorem eum fugiat quo
                voluptas nulla pariatur?
            </p>
        </div>
        <div>
            <img
                :src="`/storage/images/about_us_image.jpg`"
                alt="Team working"
                class="rounded-xl shadow-lg"
            />
        </div>
    </section>

    <!-- Values -->
    <section class="bg-white py-16">
        <div class="max-w-[1400px] mx-auto px-6">
            <h2 class="text-3xl font-medium text-center mb-12">Our Values</h2>

            <div class="grid md:grid-cols-3 gap-8">
                <div class="p-6 bg-gray-50 rounded-xl shadow-sm">
                    <h3 class="text-xl font-medium mb-2">Integrity</h3>
                    <p class="text-gray-600">
                        "Lorem ipsum dolor sit amet, consectetur adipiscing
                        elit, sed do eiusmod tempor incididunt ut labore et
                        dolore magna aliqua. Ut enim ad minim veniam, quis
                        nostrud exercitation ullamco laboris nisi ut aliquip ex
                        ea commodo consequat. Duis aute irure dolor in
                        reprehenderit in voluptate velit esse cillum dolore eu
                        fugiat nulla pariatur.
                    </p>
                </div>

                <div class="p-6 bg-gray-50 rounded-xl shadow-sm">
                    <h3 class="text-xl font-medium mb-2">Innovation</h3>
                    <p class="text-gray-600">
                        "Lorem ipsum dolor sit amet, consectetur adipiscing
                        elit, sed do eiusmod tempor incididunt ut labore et
                        dolore magna aliqua. Ut enim ad minim veniam, quis
                        nostrud exercitation ullamco laboris nisi ut aliquip ex
                        ea commodo consequat. Duis aute irure dolor in
                        reprehenderit in voluptate velit esse cillum dolore eu
                        fugiat nulla pariatur.
                    </p>
                </div>

                <div class="p-6 bg-gray-50 rounded-xl shadow-sm">
                    <h3 class="text-xl font-medium mb-2">Community</h3>
                    <p class="text-gray-600">
                        "Lorem ipsum dolor sit amet, consectetur adipiscing
                        elit, sed do eiusmod tempor incididunt ut labore et
                        dolore magna aliqua. Ut enim ad minim veniam, quis
                        nostrud exercitation ullamco laboris nisi ut aliquip ex
                        ea commodo consequat. Duis aute irure dolor in
                        reprehenderit in voluptate velit esse cillum dolore eu
                        fugiat nulla pariatur.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Team -->
    <section class="py-16">
        <div class="max-w-[1400px] mx-auto px-6">
            <h2 class="text-3xl font-medium text-center mb-12">
                Meet the Team
            </h2>

            <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-8">
                <div class="bg-white p-6 rounded-xl shadow-sm text-center">
                    <img
                        :src="`/storage/images/about_us_image.jpg`"
                        class="w-24 h-24 mx-auto rounded-full mb-4"
                        alt="Team member"
                    />
                    <h3 class="font-medium text-lg">Bernadette Herrera</h3>
                    <p class="text-gray-500 text-sm">Founder</p>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-sm text-center">
                    <img
                        :src="`/storage/images/about_us_image.jpg`"
                        class="w-24 h-24 mx-auto rounded-full mb-4"
                        alt="Team member"
                    />
                    <h3 class="font-medium text-lg">Bernadette Herrera</h3>
                    <p class="text-gray-500 text-sm">Founder</p>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-sm text-center">
                    <img
                        :src="`/storage/images/about_us_image.jpg`"
                        class="w-24 h-24 mx-auto rounded-full mb-4"
                        alt="Team member"
                    />
                    <h3 class="font-medium text-lg">Bernadette Herrera</h3>
                    <p class="text-gray-500 text-sm">Founder</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm text-center">
                    <img
                        :src="`/storage/images/about_us_image.jpg`"
                        class="w-24 h-24 mx-auto rounded-full mb-4"
                        alt="Team member"
                    />
                    <h3 class="font-medium text-lg">Bernadette Herrera</h3>
                    <p class="text-gray-500 text-sm">Founder</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm text-center">
                    <img
                        :src="`/storage/images/about_us_image.jpg`"
                        class="w-24 h-24 mx-auto rounded-full mb-4"
                        alt="Team member"
                    />
                    <h3 class="font-medium text-lg">Bernadette Herrera</h3>
                    <p class="text-gray-500 text-sm">Founder</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm text-center">
                    <img
                        :src="`/storage/images/about_us_image.jpg`"
                        class="w-24 h-24 mx-auto rounded-full mb-4"
                        alt="Team member"
                    />
                    <h3 class="font-medium text-lg">Bernadette Herrera</h3>
                    <p class="text-gray-500 text-sm">Founder</p>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {};
</script>

<style></style>
