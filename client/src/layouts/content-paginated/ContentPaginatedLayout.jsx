import { Header } from "../../components/header";
import { Box, Container, Group, Pagination, Text } from "@mantine/core";
import { Content } from "../../components/content";
import { observer } from "mobx-react-lite";
import { useStores } from "../../stores";

function ContentPaginatedLayout({ main, titleTop }) {
    const { paginationStore } = useStores();

    return (
        <div>
            <div>
                <Header py={15} logoSize={60}>
                    <Header.Search />
                </Header>

                <Container size="xl">
                    <Box py={40}>
                        <Text>{titleTop}</Text>
                    </Box>
                </Container>
            </div>
            <main>
                <Container size="xl">
                    <Content>
                        {main}
                    </Content>
                </Container>
            </main>

            <Box mt={25}>
                <Container size="xl">
                    <Content>
                        <Group justify="center">
                            <Pagination total={paginationStore.totalPages} value={paginationStore.currentPage} />
                        </Group>
                    </Content>
                </Container>
            </Box>
        </div>
    );
}

export default observer(ContentPaginatedLayout);