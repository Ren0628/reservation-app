import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import InputError from "@/Components/InputError";
import InputLabel from "@/Components/InputLabel";
import PrimaryButton from "@/Components/PrimaryButton";
import TextInput from "@/Components/TextInput";
import { Head, useForm } from "@inertiajs/react";

export default function Reservation({ auth, accommondation, errors }) {
    const { data, setData, get, processing } = useForm({
        checkin: "",
        checkout: "",
    });

    const submit = (e) => {
        e.preventDefault();

        get(route("rooms", { id: accommondation.id }));
    };

    return (
        <AuthenticatedLayout user={auth.user}>
            <Head title="予約" />
            <div className="text-center my-2 font-semibold">
                {accommondation.name}でのご予約
            </div>
            <div className="flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
                <div className="w-full sm:max-w-md my-2 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                    <form onSubmit={submit}>
                        <div>
                            <InputLabel
                                htmlFor="checkin"
                                value="チェックイン"
                            />

                            <TextInput
                                id="checkin"
                                type="date"
                                name="checkin"
                                value={data.checkin}
                                className="mt-1 block w-full"
                                isFocused={true}
                                onChange={(e) =>
                                    setData("checkin", e.target.value)
                                }
                            />

                            <InputError
                                message={errors.checkin}
                                className="mt-2"
                            />
                        </div>

                        <div className="mt-4">
                            <InputLabel
                                htmlFor="checkout"
                                value="チェックアウト"
                            />

                            <TextInput
                                id="checkout"
                                type="date"
                                name="checkout"
                                value={data.checkout}
                                className="mt-1 block w-full"
                                onChange={(e) =>
                                    setData("checkout", e.target.value)
                                }
                            />

                            <InputError
                                message={errors.checkout}
                                className="mt-2"
                            />
                        </div>

                        <div className="flex items-center justify-end mt-4">
                            <PrimaryButton
                                className="ms-4"
                                disabled={processing}
                            >
                                予約可能な部屋検索
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
