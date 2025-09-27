<script lang="ts">
    import ContentLayout from "$lib/layouts/content-layout.svelte";
    import ProjectList from "@/pages/Projects/Partials/Project-List.svelte";
    import CreateProjectForm from "$lib/components/organisms/form/project/create-project-form.svelte";

    let {projects} = $props();
</script>

<ContentLayout>
    <div class="mb-4">
        <CreateProjectForm/>
    </div>
    <ProjectList items={projects.data}/>
</ContentLayout>

