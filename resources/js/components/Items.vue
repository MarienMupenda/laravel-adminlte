<template>
    <div>
        <div class="mb-2 row">
            <div class="mb-1 col-sm-12 col-md-5 col-lg-3 col-xxl-2">
                <div
                    class="mb-1 shadow d-inline-block float-md-start me-1 search-input-container w-100 bg-foreground"
                >
                    <input
                        v-model="search"
                        class="form-control"
                        placeholder="Search"
                    />
                    <span class="search-magnifier-icon">
                        <i data-cs-icon="search"></i>
                    </span>
                    <span class="search-delete-icon d-none">
                        <i data-cs-icon="close"></i>
                    </span>
                </div>
            </div>
            <div class="mb-1 col-sm-12 col-md-7 col-lg-9 col-xxl-10 text-end">
                <div class="d-inline-block">
                    <button
                        class="shadow btn btn-icon btn-icon-only btn-foreground-alternate"
                        data-bs-toggle="tooltip"
                        data-bs-placement="top"
                        data-bs-delay="0"
                        title="Print"
                        type="button"
                    >
                        <i data-cs-icon="print"></i>
                    </button>
                    <div class="d-inline-block">
                        <button
                            class="p-0 btn"
                            data-bs-toggle="dropdown"
                            type="button"
                            data-bs-offset="0,3"
                        >
                            <span
                                class="shadow btn btn-icon btn-icon-only btn-foreground-alternate dropdown"
                                data-bs-delay="0"
                                data-bs-placement="top"
                                data-bs-toggle="tooltip"
                                title="Export"
                            >
                                <i data-cs-icon="download"></i>
                            </span>
                        </button>
                        <div class="shadow dropdown-menu dropdown-menu-end">
                            <button
                                class="dropdown-item export-copy"
                                type="button"
                            >
                                Copy
                            </button>
                            <button
                                class="dropdown-item export-excel"
                                type="button"
                            >
                                Excel
                            </button>
                            <button
                                class="dropdown-item export-cvs"
                                type="button"
                            >
                                Cvs
                            </button>
                        </div>
                    </div>
                    <div
                        class="dropdown-as-select d-inline-block"
                        data-childselector="span"
                    >
                        <button
                            class="p-0 shadow btn"
                            type="button"
                            data-bs-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false"
                            data-bs-offset="0,3"
                        >
                            <span
                                class="btn btn-foreground-alternate dropdown-toggle"
                                data-bs-toggle="tooltip"
                                data-bs-placement="top"
                                data-bs-delay="0"
                                title="Item Count"
                            >
                                10 Items
                            </span>
                        </button>
                        <div class="shadow dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="#">5 Items</a>
                            <a class="dropdown-item active" href="#"
                                >10 Items</a
                            >
                            <a class="dropdown-item" href="#">20 Items</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row g-0">
            <div class="mb-5 col-12">
                <div id="checkboxTable">
                    <div
                        class="mb-4 bg-transparent mb-lg-3 no-shadow d-none d-lg-block"
                    >
                        <div class="row g-0">
                            <div class="col-auto sw-11 d-none d-lg-flex"></div>
                            <div class="col">
                                <div class="ps-5 pe-4 h-100">
                                    <div
                                        class="row g-0 h-100 align-content-center custom-sort"
                                    >
                                        <div
                                            class="col-lg-3 d-flex flex-column mb-lg-0 pe-3"
                                        >
                                            <div
                                                class="cursor-pointer text-muted text-small sort"
                                                data-sort="name"
                                            >
                                                TITLE
                                            </div>
                                        </div>
                                        <div
                                            class="col-lg-3 d-flex flex-column pe-1 justify-content-center"
                                        >
                                            <div
                                                class="cursor-pointer text-muted text-small sort"
                                                data-sort="email"
                                            >
                                                STOCK
                                            </div>
                                        </div>
                                        <div
                                            class="col-lg-3 d-flex flex-column pe-1 justify-content-center"
                                        >
                                            <div
                                                class="cursor-pointer text-muted text-small sort"
                                                data-sort="phone"
                                            >
                                                PRICE
                                            </div>
                                        </div>
                                        <div
                                            class="col-lg-2 d-flex flex-column pe-1 justify-content-center"
                                        >
                                            <div
                                                class="cursor-pointer text-muted text-small sort"
                                                data-sort="group"
                                            >
                                                STATUS
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Items -->
                    <div v-for="item in items" key="item.id" class="mb-2 card">
                        <div class="row g-0 h-100 sh-lg-9 position-relative">
                            <a
                                :href="'/items/' + item.id"
                                class="col-auto position-relative"
                            >
                                <img
                                    :src="item.image_small"
                                    alt="product"
                                    class="card-img card-img-horizontal h-100 sw-11"
                                    style="height: 75px"
                                />
                            </a>
                            <div class="py-4 col py-lg-0">
                                <div class="ps-5 pe-4 h-100">
                                    <div
                                        class="row g-0 h-100 align-content-center"
                                    >
                                        <a
                                            :href="'items/' + item.id + '/edit'"
                                            class="order-1 mb-3 col-11 col-lg-3 d-flex flex-column mb-lg-0 pe-3 h-lg-100 justify-content-center"
                                        >
                                            {{ item.name }}
                                            <div
                                                class="text-small text-muted text-truncate position"
                                            >
                                                #{{ item.id }}
                                                <span
                                                    class="badge bg-outline-primary me-1"
                                                    >{{ item.state }}</span
                                                >
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Items -->
                </div>
            </div>
            <div class="w-100 d-flex justify-content-center">
                <nav>
                    <ul class="pagination">
                        <li
                            v-bind:class="[
                                { disabled: !pagination.prev_page_url },
                            ]"
                            class="page-item"
                        >
                            <a
                                class="shadow page-link"
                                href="#"
                                @click="fetchItems(pagination.prev_page_url)"
                                tabindex="-1"
                                aria-disabled="true"
                            >
                                <i data-cs-icon="chevron-left"></i>
                            </a>
                        </li>

                        <li
                            v-if="Number.isInteger(parseInt(link.label))"
                            v-for="link in pagination.links"
                            v-bind:class="[{ active: link.active }]"
                            class="page-item"
                        >
                            <a
                                class="shadow page-link"
                                @click="fetchItems(link.url)"
                                href="#"
                                >{{ link.label }}</a
                            >
                        </li>

                        <li
                            v-bind:class="[
                                { disabled: !pagination.next_page_url },
                            ]"
                            class="page-item"
                        >
                            <a
                                class="shadow page-link"
                                href="#"
                                @click="fetchItems(pagination.next_page_url)"
                            >
                                <i data-cs-icon="chevron-right"></i>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Items.vue",
    props: ["company"],
    mounted() {
        // console.log(this.company)
    },
    data() {
        return {
            items: [],
            item: {
                id: "",
                name: "",
                description: "",
                image: "",
                image_small: "",
                selling_price: "",
            },
            pagination: {},
            search: "",
        };
    },
    created() {
        this.fetchItems();
    },
    watch: {
        search(after, before) {
            this.fetchItems();
        },
    },
    methods: {
        fetchItems(page_url) {
            let vm = this;
            page_url = page_url || "/api/v1/items";

            console.log(page_url);
            axios
                .get(page_url, {
                    params: {
                        company_id: this.company,
                        q: this.search,
                    },
                })
                .then((res) => res.data)
                .then((res) => {
                    console.log(res);
                    vm.items = res.data;

                    vm.makePagination(res.meta, res.links);
                })
                .catch((reason) => console.log(reason));
        },
        makePagination(meta, links) {
            this.pagination = {
                current_page: meta.current_page,
                last_page: meta.last_page,
                next_page_url: links.next,
                prev_page_url: links.next,
                links: meta.links,
            };
        },
    },
};
</script>

<style scoped></style>
