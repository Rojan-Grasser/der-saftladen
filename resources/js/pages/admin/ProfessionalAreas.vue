<script lang="ts" setup>
import { Head, router } from '@inertiajs/vue3';
import { Pencil, Trash2 } from 'lucide-vue-next';
import { ref } from 'vue';

import { Button } from '@/components/ui/button';
import {
    Pagination,
    PaginationContent,
    PaginationEllipsis,
    PaginationFirst,
    PaginationItem,
    PaginationLast,
    PaginationNext,
    PaginationPrevious,
} from '@/components/ui/pagination';
import {
    Table,
    TableBody,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from '@/components/ui/table';
import {
    Tooltip,
    TooltipContent,
    TooltipProvider,
    TooltipTrigger,
} from '@/components/ui/tooltip';
import AppLayout from '@/layouts/AppLayout.vue';
import ProfessionalAreaCreate from '@/pages/admin/ProfessionalAreaCreate.vue';
import ProfessionalAreaEdit from '@/pages/admin/ProfessionalAreaEdit.vue';
import admin from '@/routes/admin';
import type {
    BreadcrumbItem,
    PaginatedResponse,
    ProfessionalArea,
} from '@/types';

defineProps<{
    professionalAreas: PaginatedResponse<ProfessionalArea>;
}>();

const handlePageChange = (page: number) => {
    router.get(
        admin.professionalArea().url,
        { page: page },
        { preserveState: true, replace: true },
    );
};

const isCreateOpen = ref(false);

const isEditOpen = ref(false);
const editingProfessionalArea = ref<ProfessionalArea | null>(null);

const editProfessionalArea = (professionalArea: ProfessionalArea) => {
    editingProfessionalArea.value = professionalArea;
    isEditOpen.value = true;
};

const deleteProfessionalArea = (professionalArea: ProfessionalArea) => {
    router.delete(admin.professionalArea.destroy(professionalArea.id));
};

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Admin Dashboard', href: admin.dashboard().url },
    { title: 'Berufsbereiche', href: admin.professionalArea().url },
];
</script>

<template>
    <Head title="Berufsbereiche" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-col gap-6 p-6">
            <div class="flex items-center">
                <Button @click="isCreateOpen = true">Neu erstellen</Button>
            </div>
            <div class="rounded-md border bg-card">
                <Table>
                    <TableHeader>
                        <TableRow>
                            <TableHead>Name</TableHead>
                            <TableHead>Beschreibung</TableHead>
                            <TableHead>Aktionen</TableHead>
                        </TableRow>
                    </TableHeader>
                    <TableBody>
                        <TableRow
                            v-for="professionalArea in professionalAreas.data"
                            :key="professionalArea.id"
                        >
                            <TableCell>
                                {{ professionalArea.name }}
                            </TableCell>
                            <TableCell class="break-all whitespace-normal">
                                {{ professionalArea.description }}
                            </TableCell>
                            <TableCell>
                                <TooltipProvider>
                                    <Tooltip>
                                        <TooltipTrigger as-child>
                                            <Button
                                                aria-label="Bearbeiten"
                                                class="mr-2"
                                                size="icon-sm"
                                                @click="
                                                    editProfessionalArea(
                                                        professionalArea,
                                                    )
                                                "
                                            >
                                                <Pencil />
                                            </Button>
                                        </TooltipTrigger>
                                        <TooltipContent>
                                            Bearbeiten
                                        </TooltipContent>
                                    </Tooltip>
                                </TooltipProvider>
                                <TooltipProvider>
                                    <Tooltip>
                                        <TooltipTrigger as-child>
                                            <Button
                                                aria-label="Löschen"
                                                size="icon-sm"
                                                variant="destructive"
                                                @click="
                                                    deleteProfessionalArea(
                                                        professionalArea,
                                                    )
                                                "
                                            >
                                                <Trash2 />
                                            </Button>
                                        </TooltipTrigger>
                                        <TooltipContent>
                                            Löschen
                                        </TooltipContent>
                                    </Tooltip>
                                </TooltipProvider>
                            </TableCell>
                        </TableRow>
                        <TableRow v-if="professionalAreas.data.length === 0">
                            <TableCell
                                class="h-24 text-center text-muted-foreground"
                                colspan="3"
                            >
                                Keine Berufsbereiche gefunden.
                            </TableCell>
                        </TableRow>
                    </TableBody>
                </Table>
            </div>
            <div
                v-if="professionalAreas.total > professionalAreas.per_page"
                class="flex items-center justify-end px-2"
            >
                <Pagination
                    v-slot="{ page }"
                    :default-page="professionalAreas.current_page"
                    :items-per-page="professionalAreas.per_page"
                    :sibling-count="1"
                    :total="professionalAreas.total"
                    @update:page="handlePageChange"
                >
                    <PaginationContent
                        v-slot="{ items }"
                        class="flex items-center gap-1"
                    >
                        <PaginationFirst />
                        <PaginationPrevious />

                        <template v-for="(item, index) in items">
                            <PaginationItem
                                v-if="item.type === 'page'"
                                :key="index"
                                :value="item.value"
                                as-child
                            >
                                <Button
                                    :variant="
                                        item.value === page
                                            ? 'default'
                                            : 'outline'
                                    "
                                    class="h-10 w-10 p-0"
                                >
                                    {{ item.value }}
                                </Button>
                            </PaginationItem>
                            <PaginationEllipsis
                                v-else
                                :key="item.type"
                                :index="index"
                            />
                        </template>

                        <PaginationNext />
                        <PaginationLast />
                    </PaginationContent>
                </Pagination>
            </div>
        </div>
        <ProfessionalAreaCreate v-model:open="isCreateOpen" />
        <ProfessionalAreaEdit
            v-if="editingProfessionalArea"
            v-model:open="isEditOpen"
            :professionalArea="editingProfessionalArea"
        />
    </AppLayout>
</template>
