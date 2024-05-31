
<aside class="bg-dark text-white pt-5">
    <ul>
        <li>
            <a href="{{ route('admin.projects.index') }}"><i class="fa-solid fa-sheet-plastic ms-1"></i>Project</a>
        </li>

        <li>
            <a href="{{ route('admin.projects.create') }}"><i class="fa-solid fa-file-circle-plus"></i>New Project</a>
        </li>

        <li>
            <a href="{{ route('admin.technologies.index') }}"><i class="fa-solid fa-compass-drafting"></i>Technology</a>
        </li>

        <li>
            <a href="{{ route('admin.types.index') }}"><i class="fa-solid fa-table-list"></i>Type</a>
        </li>




        <li class="mt-5">
            <a href="{{ route('admin.type-projects') }}"><i class="fa-solid fa-clone"></i>Type & Project</a>
        </li>
    </ul>
</aside>
