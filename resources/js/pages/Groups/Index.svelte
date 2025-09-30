<script lang="ts">
    import ContentLayout from "$lib/layouts/content-layout.svelte";
    import GroupList from "@/pages/Groups/Partials/Group-List.svelte";
    import CreateGroupForm from "$lib/components/organisms/form/group/create-group-form.svelte";

    let {groups} = $props();
</script>

<ContentLayout>
    <div class="mb-4">
        <CreateGroupForm/>
    </div>
    <GroupList items={groups.data}/>
</ContentLayout>
