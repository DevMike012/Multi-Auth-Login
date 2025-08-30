import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, Link } from '@inertiajs/react';
import Modal from '@/Components/Modal';

export default function Dashboard(props) {
    return (
        <AuthenticatedLayout
            auth={props.auth}
            errors={props.errors}
            header={<h2 className="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Dashboard</h2>}
        >
            <Modal show={props.must_change_password} onClose={() => {}} closeable={false}>
                <div className="p-6">
                    <h3 className="text-lg font-medium text-gray-900">Update your password</h3>
                    <p className="mt-2 text-sm text-gray-600">You must update your password immediately for security reasons. Please go to the change password screen now.</p>
                    <div className="mt-4 flex justify-end">
                        <Link href={route('password.change')} className="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded">Update password</Link>
                    </div>
                </div>
            </Modal>
            <Head title="Dashboard" />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="p-6 text-gray-900 dark:text-gray-100">You're logged in!</div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
