<script lang="ts">
    import ContentLayout from "$lib/layouts/content-layout.svelte";
    import ProjectList from "@/pages/Projects/Partials/Project-List.svelte";

    let {projects} = $props();
</script>

<ContentLayout>
    <ProjectList items={projects.data}/>
</ContentLayout>
