import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head } from "@inertiajs/react";

function Completion({ auth }) {
    return (
        <AuthenticatedLayout user={auth.user}>
            <Head title="予約" />
            <div className="text-center my-2 font-semibold">
                予約が完了しました
            </div>
        </AuthenticatedLayout>
    );
}

export default Completion;
