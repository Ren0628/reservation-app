<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Room;

class RoomTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rooms = [
            ['accommondation_id' => 2, 'room_number' => 101, 'type' => 'single', 'capacity' => 1],
            ['accommondation_id' => 2, 'room_number' => 102, 'type' => 'single', 'capacity' => 1],
            ['accommondation_id' => 2, 'room_number' => 103, 'type' => 'single', 'capacity' => 1],
            ['accommondation_id' => 2, 'room_number' => 104, 'type' => 'single', 'capacity' => 1],
            ['accommondation_id' => 2, 'room_number' => 105, 'type' => 'single', 'capacity' => 1],
            ['accommondation_id' => 2, 'room_number' => 106, 'type' => 'twin', 'capacity' => 2],
            ['accommondation_id' => 2, 'room_number' => 107, 'type' => 'twin', 'capacity' => 2],
            ['accommondation_id' => 2, 'room_number' => 108, 'type' => 'twin', 'capacity' => 2],
            ['accommondation_id' => 2, 'room_number' => 109, 'type' => 'double', 'capacity' => 2],
            ['accommondation_id' => 2, 'room_number' => 110, 'type' => 'double', 'capacity' => 2],
            ['accommondation_id' => 2, 'room_number' => 111, 'type' => 'double', 'capacity' => 2],
            ['accommondation_id' => 3, 'room_number' => 201, 'type' => 'two', 'capacity' => 2],
            ['accommondation_id' => 3, 'room_number' => 202, 'type' => 'two', 'capacity' => 2],
            ['accommondation_id' => 3, 'room_number' => 203, 'type' => 'two', 'capacity' => 2],
            ['accommondation_id' => 3, 'room_number' => 204, 'type' => 'two', 'capacity' => 2],
            ['accommondation_id' => 3, 'room_number' => 205, 'type' => 'two', 'capacity' => 2],
            ['accommondation_id' => 3, 'room_number' => 206, 'type' => 'four', 'capacity' => 4],
            ['accommondation_id' => 3, 'room_number' => 207, 'type' => 'four', 'capacity' => 4],
            ['accommondation_id' => 3, 'room_number' => 208, 'type' => 'four', 'capacity' => 4],
        ];

        foreach($rooms as $room) {
            Room::create($room);
        }

    }
}
