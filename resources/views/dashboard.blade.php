<x-layouts.app :title="__('My Tasks')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
			@if (count($tasks) === 0)
						<div class="w-[50px]">
						<flux:heading size="xl">Add a new task to the list</flux:heading>
						<a href="{{ route('newtask') }}" class="mt-3"><flux:button icon="plus" class="mt-3">New Task</flux:button></a>
						</div>
					@else
						<flux:heading size="xl">My Tasks</flux:heading>
			@endif
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
						@foreach($tasks as $task)
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <div class="p-6 w-full h-full shadow-sm dark:bg-neutral-600">
									<flux:separator text="{{ $task->created_at->format('d.m.Y') }}" />
        					<flux:heading size="xl" class="mb-2">{{ $task->task_name }}</flux:heading>
    							<flux:subheading class="mb-3">{{ $task->task_description }}</flux:subheading>
									<div class="flex mt-3">
									<flux:modal.trigger name="edit-task-{{ $task->id }}">
									<flux:button variant="primary" size="sm">Edit Task</flux:button>
									</flux:modal.trigger>

									<flux:modal name="edit-task-{{ $task->id }}" class="md:w-96" variant="flyout">
										<form action="/dashboard/{{ $task->id }}" method="POST">
										{{ csrf_field() }}
										{{ method_field('PUT') }}
									<div class="space-y-6">
        						<div>
            					<flux:heading size="lg">Update Task</flux:heading>
            					<flux:text class="mt-2">Make changes to your task details.</flux:text>
        						</div>
        						<flux:input label="Task name" type="text" name="task_name" placeholder="{{ $task->task_name }}" />
        						<flux:input label="Task description" type="text" name="task_description" placeholder="{{ $task->task_description }}" />
        					<div class="flex">
            				<flux:spacer />
            				<flux:button type="submit" variant="primary">Save changes</flux:button>
        					</div>
    							</div>
										</form>
									</flux:modal>

									<form action="/dashboard/{{ $task->id }}" method="POST">
									{{ csrf_field() }}
           				{{ method_field('DELETE') }}
    							<flux:button variant="danger" type="submit" size="sm" class="ml-3">Delete Task</flux:button>
									</form>
								</div>
								</div>
            </div>
						@endforeach					
        </div>
    </div>


</x-layouts.app>
