import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head } from "@inertiajs/react";

export default function Home({ auth, accommondations }) {
    return (
        <AuthenticatedLayout user={auth.user}>
            <Head title="ホーム" />
            <div className="text-center my-2 font-semibold">
                予約する宿泊施設を選択してください
            </div>

            <div className="flex flex-col items-center sm:pt-0 bg-gray-100">
                {accommondations.map((accommondation) => {
                    return (
                        <a
                            href={route("reservation", {
                                id: accommondation.id,
                            })}
                            key={accommondation.id + accommondation.name}
                            className="text-center w-full sm:max-w-md my-2 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg cursor-pointer hover:bg-blue-100"
                        >
                            {accommondation.name}
                        </a>
                    );
                })}
            </div>
        </AuthenticatedLayout>
    );
}
