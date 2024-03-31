import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, useForm } from "@inertiajs/react";
import RoomsSelect from "@/Components/RoomsSelect";
import { useState, useEffect } from "react";
import PrimaryButton from "@/Components/PrimaryButton";
import InputError from "@/Components/InputError";

export default function Reservation({
    auth,
    accommondation,
    rooms,
    checkin,
    checkout,
    errors,
}) {
    const [sumPeople, setSumPeople] = useState(0);
    const [sumCapacity, setSumCapacity] = useState({});
    const { data, setData, post, processing } = useForm({
        checkin: checkin,
        checkout: checkout,
        number_of_people: 0,
    });

    useEffect(() => {
        setData("number_of_people", sumPeople);
    }, [sumPeople]);

    const submit = () => {
        post(route("reservation.store", { id: accommondation.id }));
    };

    return (
        <AuthenticatedLayout user={auth.user}>
            <Head title="予約" />
            <div className="text-center my-2 font-semibold">
                {accommondation.name}でのご予約
            </div>
            <div className="text-center my-2 font-semibold">
                {checkin} ~ {checkout}
            </div>
            <div className="text-center my-2 font-semibold">
                現在合計:{sumPeople}人での宿泊
            </div>
            <div className="text-center my-2">
                <PrimaryButton
                    className="ms-4"
                    disabled={processing}
                    onClick={submit}
                >
                    予約
                </PrimaryButton>
                <InputError message={errors.number_of_people} className="mt-2" />
            </div>
            <div className="flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
                {rooms.map((room) => {
                    return (
                        <RoomsSelect
                            key={room.type}
                            type={room.type}
                            capacity={room.capacity}
                            count={room.count}
                            setData={setData}
                            setSumPeople={setSumPeople}
                            sumCapacity={sumCapacity}
                            setSumCapacity={setSumCapacity}
                        />
                    );
                })}
            </div>
        </AuthenticatedLayout>
    );
}
